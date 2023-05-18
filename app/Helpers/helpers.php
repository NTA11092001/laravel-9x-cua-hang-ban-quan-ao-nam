<?php

use App\Models\Categories;

function category(){
    return Categories::query()->where('status',1)->orderBy('thutu','asc')->get();
}
