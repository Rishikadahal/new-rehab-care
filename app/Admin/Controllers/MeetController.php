<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Meet;
use App\Models\User;

class MeetController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Meet';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Meet());

        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('user_id', __('User'))->display(function ($user) {
            if ($user) {
                $user = User::find($user);
                return $user->name;
            } else {
                return 'unknown';
            }
        });
        $grid->column('patient_id', __('Patient id'));
        $grid->column('link', __('Link'))->text();
        $grid->column('status', __('Status'))->select(['1' => 'pending', '2' => 'approved', '3' => 'cancelled']);
        $grid->column('date_and_time', __('Date and time'))->datetime($options = []);
        $grid->column('created_at', __('Created at'));
        $grid->option('show_create_btn', false);
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
        $show = new Show(Meet::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('patient_id', __('Patient id'));
        $show->field('link', __('Link'));
        $show->field('status', __('Status'));
        $show->field('date_and_time', __('Date and time'));
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
    {
        $form = new Form(new Meet());

        $form->email('email', __('Email'));
        $form->number('patient_id', __('Patient id'));
        $form->textarea('link', __('Link'));
        $form->number('status', __('Status'));
        $form->datetime('date_and_time', __('Date and time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
