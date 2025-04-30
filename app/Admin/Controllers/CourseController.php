<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Course;
use \App\Models\User;

class CourseController extends AdminController
{
    protected $title = 'Course';

    protected function grid()
    {
        $grid = new Grid(new Course());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('code', __('Code'));
        $grid->column('instructor', __('Instructor'));
        $grid->column('unit', __('Unit')); // ✅ Add unit to grid
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Course::with('user')->findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('code', __('Code'));
        $show->field('instructor', __('Instructor'));
        $show->field('unit', __('Unit')); // ✅ Add unit to detail
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Course());

        $form->select('id', __('Id'));

        $form->text('title', __('Title'));
        $form->text('code', __('Code'));
        $form->text('instructor', __('Instructor'));
        $form->number('unit', __('Unit'))->min(0); // ✅ Add unit to form

        return $form;
    }
}
