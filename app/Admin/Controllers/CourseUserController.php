<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Course_User;

class CourseUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Course_User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Course_User());

        $grid->column('id', __('Id'));
        $grid->column('user.name', __('Student Name')); // <-- show user name
        $grid->column('course.title', __('Course Title')); // <-- show course title
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
    
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
        $show = new Show(Course_User::with(['user', 'course'])->findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('user.name', __('Student Name')); // show name instead of ID
        $show->field('course.title', __('Course Title')); // show course title
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
    
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {$form = new Form(new Course_User());

        $form->select('user_id', __('Student Name'))
            ->options(\App\Models\User::all()->pluck('name', 'id'));
    
        $form->select('course_id', __('Course Title'))
            ->options(\App\Models\Course::all()->pluck('title', 'id'));
    
        return $form;
    }
}
