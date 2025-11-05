<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobSeeder extends Seeder
{
    public function run()
    {
        $jobs = [
            [
                'title' => 'Frontend Developer',
                'description' => 'Develop responsive web interfaces using HTML, CSS, and JavaScript.',
                'salary' => 40000,
                'location' => 'Kathmandu',
                'skills' => 'HTML, CSS, JS, React',
                'experience' => '1-2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Build server-side applications with Laravel and PHP.',
                'salary' => 50000,
                'location' => 'Kathmandu',
                'skills' => 'PHP, Laravel, MySQL',
                'experience' => '2-3 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Mobile App Developer',
                'description' => 'Create Android and iOS apps using Flutter.',
                'salary' => 45000,
                'location' => 'Pokhara',
                'skills' => 'Flutter, Dart',
                'experience' => '1-2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => 'Design user-friendly web and mobile interfaces.',
                'salary' => 35000,
                'location' => 'Lalitpur',
                'skills' => 'Figma, Adobe XD, Photoshop',
                'experience' => '1-3 years',
                'type' => 'Contract',
            ],
            [
                'title' => 'Data Analyst',
                'description' => 'Analyze business data and create reports.',
                'salary' => 40000,
                'location' => 'Kathmandu',
                'skills' => 'Excel, SQL, Tableau',
                'experience' => '2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Digital Marketing Executive',
                'description' => 'Manage social media campaigns and SEO strategies.',
                'salary' => 30000,
                'location' => 'Bhaktapur',
                'skills' => 'SEO, Social Media, Google Ads',
                'experience' => '1-2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Content Writer',
                'description' => 'Write engaging articles, blogs, and marketing content.',
                'salary' => 25000,
                'location' => 'Kathmandu',
                'skills' => 'Writing, SEO, Creativity',
                'experience' => '1-2 years',
                'type' => 'Part-time',
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Maintain CI/CD pipelines and cloud infrastructure.',
                'salary' => 60000,
                'location' => 'Kathmandu',
                'skills' => 'AWS, Docker, Kubernetes',
                'experience' => '3-5 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Software Tester',
                'description' => 'Perform QA testing for web and mobile applications.',
                'salary' => 35000,
                'location' => 'Lalitpur',
                'skills' => 'Selenium, Manual Testing, QA',
                'experience' => '1-3 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Project Manager',
                'description' => 'Manage software development projects and teams.',
                'salary' => 70000,
                'location' => 'Kathmandu',
                'skills' => 'Leadership, Agile, Scrum',
                'experience' => '5+ years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Network Engineer',
                'description' => 'Design and maintain computer networks.',
                'salary' => 50000,
                'location' => 'Pokhara',
                'skills' => 'Cisco, Networking, Security',
                'experience' => '2-4 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Graphic Designer',
                'description' => 'Create visual content for web and print.',
                'salary' => 30000,
                'location' => 'Kathmandu',
                'skills' => 'Photoshop, Illustrator, InDesign',
                'experience' => '1-3 years',
                'type' => 'Contract',
            ],
            [
                'title' => 'System Administrator',
                'description' => 'Manage servers and IT infrastructure.',
                'salary' => 45000,
                'location' => 'Lalitpur',
                'skills' => 'Linux, Windows Server, Networking',
                'experience' => '2-4 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Full Stack Developer',
                'description' => 'Work on both frontend and backend using Laravel and React.',
                'salary' => 55000,
                'location' => 'Kathmandu',
                'skills' => 'Laravel, React, MySQL',
                'experience' => '2-4 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'HR Executive',
                'description' => 'Handle recruitment, employee relations, and payroll.',
                'salary' => 35000,
                'location' => 'Bhaktapur',
                'skills' => 'HR, Communication, Payroll',
                'experience' => '1-3 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Customer Support Executive',
                'description' => 'Assist customers and resolve issues via calls and chat.',
                'salary' => 25000,
                'location' => 'Kathmandu',
                'skills' => 'Communication, Problem-solving',
                'experience' => '1-2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'SEO Specialist',
                'description' => 'Optimize website content for search engines.',
                'salary' => 35000,
                'location' => 'Kathmandu',
                'skills' => 'SEO, Google Analytics, Content Marketing',
                'experience' => '1-3 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'UI Developer',
                'description' => 'Develop modern user interfaces with HTML, CSS, and JS frameworks.',
                'salary' => 40000,
                'location' => 'Lalitpur',
                'skills' => 'HTML, CSS, JS, Vue.js',
                'experience' => '1-2 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Data Scientist',
                'description' => 'Analyze data to provide insights and build predictive models.',
                'salary' => 70000,
                'location' => 'Kathmandu',
                'skills' => 'Python, R, Machine Learning',
                'experience' => '3-5 years',
                'type' => 'Full-time',
            ],
            [
                'title' => 'Technical Writer',
                'description' => 'Create manuals, guides, and technical documentation.',
                'salary' => 30000,
                'location' => 'Pokhara',
                'skills' => 'Writing, Documentation, Tech Knowledge',
                'experience' => '1-2 years',
                'type' => 'Contract',
            ],
        ];

        foreach ($jobs as $job) {
            Job::create(array_merge($job, ['user_id' => 2, 'location' => $job['location'] ?? 'BTM', 'description' => $job['description'] ?? 'Hello World', 'type' => $job['type'] ?? 'Programmer']));
        }
    }
}
