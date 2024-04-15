<?php

namespace App\Admin\Controllers\Patient;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Patient;
use App\Models\User;

class PatientController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Patient';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Patient());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('age', __('Age'));
        $grid->column('past_illness', __('Past illness'));
        $grid->column('current_health', __('Current health'));
        $grid->column('medications', __('Medications'));
        $grid->column('contact_details', __('Contact details'));
        $grid->column('gender', __('Gender'));
        $grid->column('status', __('Status'))->select(['1' => 'pending', '2' => 'approved', '3' => 'cancelled']);
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
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
        $show = new Show(Patient::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('age', __('Age'));
        $show->field('past_illness', __('Past illness'));
        $show->field('current_health', __('Current health'));
        $show->field('medications', __('Medications'));
        $show->field('contact_details', __('Contact details'));
        $show->field('gender', __('Gender'));
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
        $form = new Form(new Patient());

        $form->text('name', __('Name'));
        $form->number('age', __('Age'));
        // $form->text('email', __('Email'));
        $form->select('user_id', __('UserId'))->options(User::all()->where('role', 'parent')->pluck('name', 'id'));
        $form->textarea('past_illness', __('Past illness'));
        $form->textarea('current_health', __('Current health'));
        $form->textarea('medications', __('Medications'));
        $form->textarea('contact_details', __('Contact details'));
        $form->text('gender', __('Gender'));
        $form->select('status', __('Status'))->options(['1' => 'pending', '2' => 'approved', '3' => 'cancelled']);


        return $form;
    }
}
