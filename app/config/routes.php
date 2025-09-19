<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/

/* $router->get('/', 'Welcome::index'); */
$router->get('/', 'StudentsController::get_all');

// Students routes
$router->get('/users', 'StudentsController::get_all');
$router->get('/users/get-all', 'StudentsController::get_all');
$router->get('/users/get-all/{page}', 'StudentsController::get_all');

$router-> match('/users/create', 'StudentsController::create', ['GET', 'POST']);
$router->match('/users/update/{id}', 'StudentsController::update', ['GET', 'POST']);

$router->get('/users/delete/{id}', 'StudentsController::delete');       // Soft delete
$router->get('/users/deleted', 'StudentsController::deleted');          // View deleted
$router->get('/users/restore/{id}', 'StudentsController::restore');     // Restore
$router->get('/users/hard_delete/{id}', 'StudentsController::hard_delete'); // Permanent deletess