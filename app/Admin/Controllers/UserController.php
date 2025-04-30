<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
    
        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Name');
        $grid->column('email', 'Email');
        $grid->column('matric_number', 'Matric Number');
        $grid->column('level', 'Level');
        $grid->column('program', 'Program');
        $grid->column('gpa', 'GPA');
        $grid->column('cgpa', 'CGPA');
       
    $grid->column('course_timetable', 'Course Timetable')->limit(30);
    $grid->column('exam_timetable', 'Exam Timetable')->limit(30);
    $grid->column('tuition_balance', 'Tuition Balance');
    $grid->column('payment_history', 'Payment History')->limit(30);
        $grid->column('created_at', 'Registered At');
        $grid->quickSearch('name', 'email', 'matric_number');
    
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));
    
        $show->field('id', __('ID'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('matric_number', __('Matric Number'));
        $show->field('level', __('Level'));
        $show->field('program', __('Program'));
        $show->field('gpa', __('GPA'));
        $show->field('cgpa', __('CGPA'));
        $show->field('email_verified_at', __('Email Verified At'));
        $show->field('remember_token', __('Remember Token'));
       
        $show->field('course_timetable', 'Course Timetable');
        $show->field('exam_timetable', 'Exam Timetable');
        $show->field('tuition_balance', 'Tuition Balance');
        $show->field('payment_history', 'Payment History');
        $show->field('created_at', __('Created At'));
        $show->field('updated_at', __('Updated At'));
    
        return $show;
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());
    
        $form->text('name', 'Name')->required();
        $form->email('email', 'Email')->required();
        $form->text('matric_number', 'Matric Number');
        $form->text('level', 'Level');
        $form->text('program', 'Program');
        $form->decimal('gpa', 'GPA')->default(0.00);
        $form->decimal('cgpa', 'CGPA')->default(0.00);
      
    $form->textarea('course_timetable', 'Course Timetable');
    $form->textarea('exam_timetable', 'Exam Timetable');

    $form->decimal('tuition_balance', 'Tuition Balance')->default(0);
    $form->textarea('payment_history', 'Payment History');

    
        return $form;
    }
}
