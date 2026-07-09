<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

/**
 * Seeds the full course catalogue for the three program tracks.
 *
 * Sources (client documents):
 *  - COURSES FOR BACHELOR'S DEGREE PROGRAMME.docx
 *  - COURSES FOR SPECIAL EXECUTIVE BACHELOR.docx
 *  - COURSES FOR MASTER'S DEGREE PROGRAMME.docx
 *  - Lecturer and Courses Taught.docx (instructor assignments)
 *
 * Safe to re-run: rows are keyed on program + level + semester + title.
 */
class CourseSeeder extends Seeder
{
    /**
     * Primary lecturer per course title, from "Lecturer and Courses Taught".
     * Where several lecturers teach the same course, the one who lists it
     * most specifically was chosen. Courses with no listed lecturer get TBA.
     */
    private const INSTRUCTORS = [
        'Basic English'                     => 'ChuQas',
        'Mission Perspective'               => 'Rev Coker',
        'Principle of Writing'              => 'ChuQas',
        'Survey of Acts'                    => 'Rev Coker',
        'Music'                             => 'ChuQas',
        'Educational Psychology'            => 'TBA',
        'Computer Science'                  => 'Rev. Adetogun Adewuyi',
        'General Physical Science'          => 'Omotoso Ebenezer A.',
        'Sociology'                         => 'Alade Samson O.',
        'Bible Introduction'                => 'Pst Sam Adenuga',
        'Pentateuch'                        => 'Olayemi T.S.',
        'Spiritual Formation & Ministry'    => 'Lekan',
        'Synoptic Gospel'                   => 'Lekan',
        'Hausa'                             => 'Mr. Samuel Alfa',
        'Hebrew History'                    => 'Alade Samson O.',
        'Johannine Writings'                => 'Rev. Julius Oni',
        'Church History / Christianity in Africa' => 'Rev Ameh Micheal Ojonumi',
        'Church History'                    => 'Rev Ameh Micheal Ojonumi',
        'French'                            => 'Mr. Samuel Alfa',
        'Project Management & Finance'      => 'Rev. Julius Oni',
        'Hermeneutics'                      => 'Olayemi T.S.',
        'New Testament Greek I'             => 'Alade Samson O.',
        'New Testament Greek'               => 'Alade Samson O.',
        'Christian Education'               => 'Rev. Adetogun Adewuyi',
        'General Epistles'                  => 'Rev Mrs H. Rogho',
        'Systematic Theology I'             => 'Rev. Julius Ogah',
        'Systematic Theology II'            => 'Rev. Julius Ogah',
        'Hebrew Language I'                 => 'Dr Obaje, U. S.',
        'Homiletics'                        => 'Dr Adeyanju Peter',
        'Evangelism and Church Planting'    => 'Pst Julie',
        'Pauline Epistles'                  => 'Rev Adeyeye',
        'Foursquare Doctrine and Polity'    => 'Oderinde Oluwatosin',
        'Church Org./Admin/Foursquare Polity' => 'Oderinde Oluwatosin',
        'Pastoral Theology'                 => 'Rev Coker',
        'Romans & Galatians'                => 'Rev Gift Ebere Okereke',
        'World Religion'                    => 'Rev. Julius Oni',
        'Research Methodology'              => 'Pst Julie',
        'Research Method'                   => 'Pst Julie',
        'Pastoral Counseling'               => 'Sis Kayode',
        'Christian Ethics'                  => 'Sis Kayode',
        'Daniel & Revelation'               => 'Olayemi T.S.',
        'Hebrew Prophets'                   => 'Olayemi T.S.',
        'Acts'                              => 'Rev Gift Ebere Okereke',
        'Acts of the Apostles'              => 'Rev Gift Ebere Okereke',
        'Apologetics'                       => 'Dr. Ojile, B. A.',
        'Old Testament Biblical Theology (O.T.B.T)' => 'Rev. Julius Oni',
        'Christian Education & Leadership'  => 'Dr. Ojile, B. A.',
        'Agape'                             => 'Rev Mrs H. Rogho',
        'Agape & Human Relation'            => 'Rev Mrs H. Rogho',
        'Church & African Realities'        => 'Dr Adeyanju Peter',
        'Public Speaking'                   => 'Pst Julie',
        'Strategy for Church Growth'        => 'Rev. Julius Oni',
        'Biblical Theology of Mission'      => 'Rev. Julius Oni',
        'Spiritual Gift/Ministry'           => 'Izirein T.A.',
        'Cross-Cultural Communication'      => 'Rev Coker',
        // Masters
        'Apologetics and Church Outreach'   => 'Rev Dr. J. Rogho',
        'Applied Exegesis'                  => 'Rev. Julius Oni',
        'Conflict Management'               => 'TBA',
        'Advanced Research Methods'         => 'Rev Dr Mrs Emessiri',
        'Entrepreneurship/Ethics of Success' => 'Rev Dr Mrs Emessiri',
        'Theology and Development'          => 'Rev Dr Idowu',
        'Leadership in Contemporary Times'  => 'Rev Dr Idowu',
        'Thesis'                            => 'TBA',
        'Bible as Literature'               => 'TBA',
        'Issues in Biblical Studies'        => 'Rev Dr Idowu',
        'Hebrew/Greek'                      => 'Dr Obaje, U. S.',
        'Advanced Systematic Theology'      => 'Dr. Ojile, B. A.',
        'Trends in African Christian Theology' => 'TBA',
        'Principles and Practice of Leadership' => 'Rev Dr Idowu',
        'Christian Leadership'              => 'Pst Julie',
        'Management'                        => 'TBA',
        'Church and Public Relations'       => 'TBA',
        'Mentoring'                         => 'TBA',
        'Church Growth in African Context'  => 'Rev Dr Mrs Emessiri',
        'Interfaith Dialogue'               => 'TBA',
        'Growing a Mega Church'             => 'TBA',
        'Management in Missions'            => 'TBA',
        'Advanced Cross-Cultural Church Planting' => 'Rev Dr Mrs Emessiri',
        'Foundation for Christian Education' => 'Rev. Adetogun Adewuyi',
        'Instructional Design: Theory & Practice' => 'TBA',
        'Bible College Administration'      => 'TBA',
        'Educational Administration'        => 'TBA',
        'Philosophy of Christian Education' => 'TBA',
        'Curriculum Development'            => 'TBA',
    ];

    public function run(): void
    {
        foreach ($this->bachelor() as $level => $semesters) {
            $this->seedGroup('bachelor', (string) $level, $semesters);
        }

        foreach ($this->specialExecutive() as $level => $modules) {
            $this->seedGroup('special_executive', (string) $level, $modules);
        }

        $this->seedGroup('masters', 'Masters', $this->masters());
    }

    /**
     * @param array<string, array<int, array{0:string,1:string,2?:float}>> $semesters semester => [[code, title, unit?], …]
     */
    private function seedGroup(string $program, string $level, array $semesters): void
    {
        foreach ($semesters as $semester => $courses) {
            foreach ($courses as $course) {
                [$code, $title] = $course;
                $unit = $course[2] ?? 3;

                Course::updateOrCreate(
                    [
                        'program'  => $program,
                        'level'    => $level,
                        'semester' => $semester,
                        'title'    => $title,
                    ],
                    [
                        'code'       => $code,
                        'unit'       => $unit,
                        'instructor' => self::INSTRUCTORS[$title] ?? 'TBA',
                    ]
                );
            }
        }
    }

    private function bachelor(): array
    {
        return [
            100 => [
                'First Semester' => [
                    ['EN103', 'Basic English'],
                    ['MS104', 'Mission Perspective'],
                    ['EN111', 'Principle of Writing'],
                    ['', 'Survey of Acts'],
                    ['MU106/B112', 'Music'],
                ],
                'Second Semester' => [
                    ['ED101', 'Educational Psychology'],
                    ['GM107', 'Computer Science'],
                    ['EN102', 'General Physical Science'],
                    ['GM109', 'Sociology'],
                ],
            ],
            200 => [
                'First Semester' => [
                    ['B202', 'Bible Introduction'],
                    ['B201', 'Pentateuch'],
                    ['B202', 'Spiritual Formation & Ministry'],
                    ['B206', 'Synoptic Gospel'],
                    ['HL201', 'Hausa'],
                ],
                'Second Semester' => [
                    ['B209', 'Hebrew History'],
                    ['GM204', 'Johannine Writings'],
                    ['H211', 'Church History / Christianity in Africa'],
                    ['', 'French'],
                    ['', 'Project Management & Finance'],
                ],
            ],
            300 => [
                'First Semester' => [
                    ['GM204', 'Hermeneutics'],
                    ['LG203', 'New Testament Greek I'],
                    ['GM108', 'Christian Education'],
                    ['GM309', 'General Epistles'],
                    ['TH215', 'Systematic Theology I'],
                ],
                'Second Semester' => [
                    ['LG416', 'Hebrew Language I'],
                    ['GM205', 'Homiletics'],
                    ['EV214', 'Evangelism and Church Planting'],
                    ['B303', 'Pauline Epistles'],
                ],
            ],
            400 => [
                'First Semester' => [
                    ['GM304', 'Foursquare Doctrine and Polity'],
                    ['GM302', 'Pastoral Theology'],
                    ['B301', 'Romans & Galatians'],
                    ['GM301', 'World Religion'],
                    ['GM415', 'Research Methodology'],
                ],
                'Second Semester' => [
                    ['GM302', 'Pastoral Counseling'],
                    ['SO307', 'Christian Ethics'],
                    ['B305', 'Daniel & Revelation'],
                    ['B208', 'Systematic Theology II'],
                    ['TH302', 'Hebrew Prophets'],
                ],
            ],
            500 => [
                'First Semester' => [
                    ['B403', 'Acts'],
                    ['EN407', 'Apologetics'],
                    ['', 'Old Testament Biblical Theology (O.T.B.T)'],
                    ['ED401', 'Christian Education & Leadership'],
                ],
                'Second Semester' => [
                    ['GM402', 'Agape'],
                    ['GM408', 'Church & African Realities'],
                    ['GM405', 'Public Speaking'],
                    ['EN407', 'Strategy for Church Growth'],
                    ['', 'Biblical Theology of Mission'],
                ],
            ],
        ];
    }

    private function specialExecutive(): array
    {
        return [
            100 => [
                'Module 1' => [
                    ['TH-215', 'Systematic Theology I'],
                    ['GM-210', 'Homiletics'],
                    ['GM-304', 'Church Org./Admin/Foursquare Polity'],
                ],
                'Module 2' => [
                    ['GM-305', 'Pastoral Counseling'],
                    ['TH-302', 'Systematic Theology II'],
                    ['HI-211', 'Church History'],
                ],
                'Module 3' => [
                    ['GM-313', 'Pastoral Theology'],
                    ['GM-204', 'Hermeneutics'],
                    ['B-309', 'General Epistles'],
                ],
                'Module 4' => [
                    ['LH-212', 'Hebrew Language I'],
                    ['GM-311', 'Research Method'],
                    ['EN-407', 'Strategy for Church Growth'],
                ],
            ],
            200 => [
                'Module 1' => [
                    ['GM-402', 'Apologetics'],
                    ['B-309', 'Daniel & Revelation'],
                    ['SO-307', 'Christian Ethics'],
                ],
                'Module 2' => [
                    ['TH-312', 'Christian Education & Leadership'],
                    ['B-403', 'Acts of the Apostles'],
                    ['GM-405', 'Public Speaking'],
                ],
                'Module 3' => [
                    ['GM-408', 'Church & African Realities'],
                    ['B-301', 'Romans & Galatians'],
                    ['TH-401', 'Biblical Theology of Mission'],
                ],
                'Module 4' => [
                    ['GN-306', 'World Religion'],
                    ['B-404', 'Agape & Human Relation'],
                ],
            ],
            300 => [
                'Module 1' => [
                    ['B-202', 'Bible Introduction'],
                    ['B-206', 'Synoptic Gospel'],
                    ['B-201', 'Pentateuch'],
                ],
                'Module 2' => [
                    ['B-213', 'Johannine Writings'],
                    ['GM-207', 'Spiritual Gift/Ministry'],
                    ['LG-203', 'Cross-Cultural Communication'],
                ],
                'Module 3' => [
                    ['B-209', 'Hebrew History'],
                    ['LG-203', 'Evangelism and Church Planting'],
                    ['GM-108', 'Christian Education'],
                ],
                'Module 4' => [
                    ['LG-203', 'New Testament Greek'],
                    ['B-303', 'Pauline Epistles'],
                    ['B-310', 'Hebrew Prophets'],
                ],
            ],
        ];
    }

    private function masters(): array
    {
        return [
            'Core Courses' => [
                ['GS 610', 'Apologetics and Church Outreach', 3],
                ['BIB 611', 'Applied Exegesis', 3],
                ['CA 612', 'Conflict Management', 3],
                ['RES 613', 'Advanced Research Methods', 3],
                ['GS 614', 'Entrepreneurship/Ethics of Success', 3],
                ['TH 615', 'Theology and Development', 3],
                ['CA 616', 'Leadership in Contemporary Times', 3],
                ['CA 617', 'Thesis', 4],
            ],
            'Biblical Studies' => [
                ['BIB 620', 'Bible as Literature', 3],
                ['TH 621', 'Issues in Biblical Studies', 3],
                ['BIB 622', 'Hebrew/Greek', 3],
                ['ATH 623', 'Advanced Systematic Theology', 3],
                ['ATH 624', 'Trends in African Christian Theology', 3],
            ],
            'Leadership' => [
                ['CA 620', 'Principles and Practice of Leadership', 3],
                ['CA 621', 'Christian Leadership', 3],
                ['CA 622', 'Management', 3],
                ['CA 623', 'Church and Public Relations', 3],
                ['CA 624', 'Mentoring', 3],
            ],
            'Mission/Church Growth' => [
                ['MC 620', 'Church Growth in African Context', 3],
                ['MC 621', 'Interfaith Dialogue', 3],
                ['MC 622', 'Growing a Mega Church', 3],
                ['MC 623', 'Management in Missions', 3],
                ['MC 624', 'Advanced Cross-Cultural Church Planting', 1.5],
            ],
            'Christian Education' => [
                ['CE 620', 'Foundation for Christian Education', 3],
                ['CE 621', 'Instructional Design: Theory & Practice', 1.5],
                ['CE 622', 'Bible College Administration', 1.5],
                ['CE 623', 'Educational Administration', 3],
                ['CE 624', 'Philosophy of Christian Education', 3],
                ['CE 625', 'Curriculum Development', 3],
            ],
        ];
    }
}
