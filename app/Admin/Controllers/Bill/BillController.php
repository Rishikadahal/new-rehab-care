<?php

namespace App\Admin\Controllers\Bill;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Bill;
use App\Models\Patient;

class BillController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bill';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Bill());

        $grid->column('id', __('Id'));
        $grid->column('patient_id', __('Patient id'));
        $grid->column('particular', __('Particular'));
        $grid->column('bill_amount', __('Bill amount'));
        $grid->column('bill_status', __('Bill status'));
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
        $show = new Show(Bill::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('patient_id', __('Patient id'));
        $show->field('particular', __('Particular'));
        $show->field('bill_amount', __('Bill amount'));
        $show->field('bill_status', __('Bill status'));
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
        $form = new Form(new Bill());

        $form->select('patient_id', __('Patient id'))->options(Patient::all()->pluck('name', 'id'));
        $form->text('particular', __('Particular'));
        $form->text('bill_amount', __('Bill amount'));
        $form->select('bill_status', __('Bill status'))->options(['1'=>'Paid','2'=>'Unpaid']);

        return $form;
    }
}
