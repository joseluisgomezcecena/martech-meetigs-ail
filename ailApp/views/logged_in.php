<?php

require_once("views/includes/header.php");
require_once("views/includes/sidebar.php");
require_once("views/includes/topbar.php");



switch($page)
{
    //users
    case "user_profile":
        include("pages/account/user_profile.php");
    break;

    case "user_list":
        include("pages/users/user_list.php");
    break;

    case "user_form":
        include("pages/account/user_form.php");
    break;

    case "user_view":
        include("pages/users/user_view.php");
    break;

    case "user_add":
        include("pages/users/user_add.php");
    break;

    case "user_update":
        include("pages/users/user_update.php");
    break;

    case "user_delete":
        include("pages/users/user_delete.php");
    break;

    //profiles
    case "profile_update":
        include("pages/profile/profile_update.php");
    break;

    //groups

    case "meeting_list":
        include("pages/meetings/meeting_list.php");
    break;

    case "meeting_add":
        include("pages/meetings/meeting_add.php");
    break;

    case "meeting_edit":
        include("pages/meetings/meeting_edit.php");
    break;

    case "meeting_delete":
        include("pages/meetings/meeting_delete.php");
    break;

    case "meeting_complete":
        include("pages/meetings/meeting_complete.php");
    break;

    case "meeting_view":
        include("pages/meetings/meeting_view.php");
    break;

    case "action_add":
        include("pages/actions/action_add.php");
    break;

    case "action_edit":
        include("pages/actions/action_edit.php");
    break;

    case "action_add_update":
        include("pages/actions/action_add_update.php");
    break;

    case "action_add_file":
        include("pages/actions/action_add_file.php");
    break;

    case "action_progress":
        include("pages/actions/action_progress.php");
    break;


    case "action_add_file2":
        include("pages/actions/action_add_file2.php");
    break;

    case "view_update":
        include("pages/updates/view_update.php");
    break;

    case "report_active_list":
        include("pages/reports/report_active_list.php");
    break;

    case "report_historic_list":
        include("pages/reports/report_historic_list.php");
    break;

    case "report":
        include("pages/reports/report.php");
    break;

    case "meeting_report":
        include("pages/reports/meeting_report.php");
    break;

    //import data
    case "andon_sites":
        include("pages/site/site_list.php");
    break;

    case "site_add":
        include("pages/site/site_add.php");
    break;

    case "site_edit":
        include("pages/site/site_edit.php");
    break;

    case "site_delete":
        include("pages/site/site_delete.php");
    break;


    case "andon_areas":
        include("pages/area/area_list.php");
    break;

    case "area_add":
        include("pages/area/area_add.php");
    break;

    case "area_edit":
        include("pages/area/area_edit.php");
    break;

    case "area_delete":
        include("pages/area/area_delete.php");
    break;


    case "andon_machines":
        include("pages/machines/machines.php");
    break;

    case "importcsvpersonnel":
        include("pages/data/importcsvpersonnel.php");
    break;

    //cells
    case "cells":
        include("pages/data/cells.php");
    break;

    //cells
    case "ops":
        include("pages/data/ops.php");
    break;

    //cells - operations menu
    case "cell_op":
        include("pages/data/cell_op.php");
    break;

    case "assign_sop_menu":
        include("pages/data/assign_sop_menu.php");
    break;

    case "assign_sop":
        include("pages/data/assign_sop.php");
    break;

    case "trained":
        include("pages/view/trained.php");
    break;

    case "trained_supervisor":
        include("pages/view/trained_supervisor.php");
    break;

    case "manual":
        include("pages/usermanual/manual.php");
    break;



    //default page
    default:
        include("pages/default.php");
    break;
}






require_once("views/includes/footer.php"); ?>


