<?php
/**
 * Created by PhpStorm.
 * User: sierra
 * Date: 22/07/17
 * Time: 01:52
 */
?>
<li class="{{ Request::is('*home*') ? 'active' : '' }}">
    <a href="{!! route('root..home') !!}"><i class="fa fa-dashboard"></i><span>{!! trans('words.dashboard') !!}</span></a>
</li>


<li class="{{ Request::is('root.contacts*') ? 'active' : '' }}">
    <a href="{!! route('admin.contacts.index') !!}"><i class="fa fa-phone"></i><span>{!! trans('words.contacts') !!}</span></a>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-bar-chart"></i> <span>{!! trans('words.reports') !!}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="{{ Request::is('root.accounts*') ? 'active' : '' }}">
            <a href="{!! route('root..accounts.index') !!}"><i class="fa fa-key"></i><span>{!! trans('words.accounts') !!}</span></a>
        </li>
        <?php /*
        <li class="{{ Request::is('root.emails*') ? 'active' : '' }}">
            <a href="{!! route('admin.emails.index') !!}"><i class="fa fa-envelope"></i><span>{!! trans('words.emails') !!}</span></a>
        </li>
        <li class="{{ Request::is('*logs*') ? 'active' : '' }}">
            <a href="{!! route('root..logs') !!}"><i class="fa fa-file-text"></i><span>{!! trans('words.logs') !!}</span></a>
        </li>
        <li class="{{ Request::is('root.services*') ? 'active' : '' }}">
            <a href="{!! route('root..services.index') !!}"><i class="fa fa-flash"></i><span>{!! trans('words.services') !!}</span></a>
        </li>
        <li class="{{ Request::is('root.dominios*') ? 'active' : '' }}">
            <a href="{!! route('root..dominios.index') !!}"><i class="fa fa-laptop"></i><span>{!! trans('words.dominios') !!}</span></a>
        </li>
        */ ?>
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-gavel"></i> <span>{!! trans('words.root') !!}</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu" style="display: none;">
        <li class="{{ Request::is('root.categories*') ? 'active' : '' }}">
            <a href="{!! route('root..categories.index') !!}"><i class="fa fa-share"></i><span>{!! trans('words.categories') !!}</span></a>
        </li>
        <li class="{{ Request::is('root.users*') ? 'active' : '' }}">
            <a href="{!! route('root..users.index') !!}"><i class="fa fa-child"></i><span>{!! trans('words.users') !!}</span></a>
        </li>
        <li class="{{ Request::is('root.roles*') ? 'active' : '' }}">
            <a href="{!! route('root..roles.index') !!}"><i class="fa fa-users"></i><span>{!! trans('words.groups') !!}</span></a>
        </li>
        <li class="{{ Request::is('root.permissions*') ? 'active' : '' }}">
            <a href="{!! route('root..permissions.index') !!}"><i class="fa fa-eye"></i><span>{!! trans('words.permissions') !!}</span></a>
        </li>
    </ul>
</li>
