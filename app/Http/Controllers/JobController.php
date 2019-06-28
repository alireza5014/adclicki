<?php

namespace App\Http\Controllers;

use App\classes\UpLoad;
use App\Http\Requests\JobRequest;

use App\Model\Category;
use App\Model\City;
use App\Model\Job;
use App\Model\Possibility;
use App\Model\State;
use App\Model\SubCategory;
use App\Traits\JobTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\type;
use Spatie\Geocoder\Geocoder;

class JobController extends Controller
{

    use JobTrait;


    public function edit($id)
    {


        $possibilities = $this->getPossibilities();
        $state = $this->getState();
        $categories = $this->getCategory();

        $job = Job::where('user_id', getUserId())
            ->where('id', $id)
            ->with('work_times')
            ->with('socials')
            ->with('possibilities:id')
            ->first();
        return view('user.job.edit', compact('state', 'city', 'categories', 'possibilities', 'job'));

    }

    public function new()
    {


//        $client = new \GuzzleHttp\Client();
//
//        $geocoder = new Geocoder($client);
//
//        $geocoder->setApiKey(config('geocoder.key'));
//
//         $geocoder->getCoordinatesForAddress('Infinite Loop 1, Cupertino');


        $possibilities = $this->getPossibilities();
        $state = $this->getState();
        $categories = $this->getCategory();

         $job = Job::where('user_id', getUserId())
            ->with(['sub_category' => function ($q) {
                return $q->with('category');
            }])
//            ->with('work_times')
//            ->with('socials')
//            ->with('possibilities:id')
            ->first();
        if ($job) {
            $published = $job->is_published;
            return view('user.job.waiting', compact('job', 'published'));

        } else
            return view('user.job.create', compact('state', 'city', 'categories', 'possibilities'));
    }


    public function create(JobRequest $request)
    {

        DB::beginTransaction();
        try {
            $job = $this->insertJob($request);
            $job->possibilities()->attach($request->possibilities, ['expire_date' => $this->expireDate()]);

            $this->insertRate($job);

            $this->insertImages($request, $job);
            $this->insertWorkTime($request, $job);
            $this->insertSocials($request, $job);
            $this->insertVideo($request, $job);
            DB::commit();
            return route('new_job');

        } catch (\Exception $e) {


            // به هر دلیل یکی از Query ها اجرا نشه بقیه Query ها رول بک میشن
            DB::rollback();
            flash()->error('توجه', 'error');
            return $e->getMessage();

        }


    }

    public function modify($id, JobRequest $request)
    {

// return $request->all();

        DB::beginTransaction();
        try {
//            Job::where('id', $id)->delete();

            $this->modifyJob($id, $request);
            $job = Job::find($id);
            $this->modifyWorkTime($request, $job);
            $this->modifySocial($request, $job);
            $this->modifyImages($request, $job);


            $job->possibilities()->sync($request->possibilities, ['expire_date' => $this->expireDate()]);

            $job->push();
            DB::commit();

            return route('new_job');

        } catch (\Exception $e) {

            // به هر دلیل یکی از Query ها اجرا نشه بقیه Query ها رول بک میشن
            DB::rollback();
            flash()->error('توجه', 'error');


        }

    }

    public function delete($id)
    {
        Job::where('id', $id)->delete();

        return back();

    }


}
