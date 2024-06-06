<?php

namespace App\Http\Controllers\job_seeker;

use App\Models\Job;
use App\Models\JobSeeker;
use App\Models\JobCategory;
use App\Models\JobTimeType;

use App\Models\Testimonial;
use App\Models\ApplyProcess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        $applyProcesses = ApplyProcess::all();


        $categories = JobCategory::limit(8)->get();
        $jobs = Job::all(); // Ambil semua pekerjaan, atau sesuaikan query jika diperlukan
        $jobs = Job::with('jobTime', 'company', 'jobcategory')->get();

        // Menghitung jumlah pekerjaan per kategori
        $jobCounts = Job::select('job_category_id', DB::raw('count(*) as total'))
                        ->groupBy('job_category_id')
                        ->pluck('total', 'job_category_id');

        $data = [
            "title" => "Job Category",
            "categories" => $categories,
            "jobs" => $jobs,
            "applyProcesses" => $applyProcesses,
            "jobCounts" => $jobCounts,
            "testimonials" => $testimonials
        ];
        return view('job-seekers.index', $data);
    }

    public function getJobCategory()
    {
        $categories = JobCategory::limit(8)->get();
        $data = [
            "title" => "Job Category",
            "categories" => $categories,
        ];

        return view('job-seekers.index', $data);
    }

    public function listJob()
    {
        $categories = JobCategory::all();
        $data = [
            "title" => "All Job Categories",
            "categories" => $categories,
        ];

        return view('job-seekers.list-job', $data);
    }

    public function jobDetails()
    {
        $categories = JobCategory::all();
        $jobs = Job::all(); // Ambil semua pekerjaan, atau sesuaikan query jika diperlukan
        $jobs = Job::with('jobTime', 'company')->get();
        $data = [
            "title" => "Job Category",
            "categories" => $categories,
            "jobs" => $jobs,
        ];

        return view('job-seekers.job-details', $data);
    }


    public function Testimoni()
    {
        $user = Auth::user();
        $jobseeker = JobSeeker::with('user')->where('id', $user->id)->first();
        $testimonials = Testimoni::all();

        // Mengirim data ke view
        return view('job-seekers.index', [
            'jobseeker' => $jobseeker,
            'testimonials' => $testimonials,
        ]);
    }

    public function jobSeekerIndex()
    {
        $testimonials = Testimoni::all();
        return view('job-seeker.testimoni.index', compact('testimonials'));
    }

    public function search(Request $request)
    {
        $jobCategoryId = Request()->input("job_category_id");
        $jobTimeType = Request()->input("job_time_type_id");
        $job_category = JobCategory::all();
        $job_time = JobTimeType::all();
        $jobEloquent = Job::with('jobTime', 'company', 'jobcategory');
        if ($jobCategoryId) {
            $jobEloquent->where("job_category_id", $jobCategoryId);
        } elseif ($jobTimeType) {
            $jobEloquent->where("job_time_type_id", $jobTimeType);
        }
        $jobs = $jobEloquent->paginate(10);
        $totalJob = $jobEloquent->count();

        $data = ([
            "job_category" => $job_category,
            "job_time" => $job_time,
            "jobs" => $jobs,
            "totalJob" => $totalJob,
            'jobCategoryId' => $jobCategoryId,
            "jobTimeType" => $jobTimeType

        ]);

        $keyword = $request->input('keyword');
        $jobs = Job::where('title', 'LIKE', '%' . $keyword . '%')
            ->orWhere('description', 'LIKE', '%' . $keyword . '%')
            ->get();

        return view('job-seekers.job-listing', ['jobs' => $jobs], $data);
    }
}
