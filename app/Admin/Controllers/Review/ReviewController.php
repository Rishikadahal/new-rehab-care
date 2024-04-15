<?php

namespace App\Admin\Controllers\Review;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Review;
use App\Models\User;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'));
        $grid->column('review', __('Review'));
        $grid->column('message', __('Message'));
        $grid->column('user_id', __('User id'))->display(function($id){
            return User::find($id)->name;
        });
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
        $show = new Show(Review::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('review', __('Review'));
        $show->field('message', __('Message'));
        $show->field('user_id', __('User id'));
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
        $form = new Form(new Review());

        $form->number('review', __('Review'));
        $form->textarea('message', __('Message'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
