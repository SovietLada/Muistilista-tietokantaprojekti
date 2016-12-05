<?php

class CategoryController extends BaseController {
    
    public static function show($id) {
        
        $category = Category::find($id);
        $memos = Memo::findMemosByCategory($id, parent::get_user_logged_in()->id);
        View::make('category_show.html', array('category' => $category, 'memos' => $memos));
    }
    
}
