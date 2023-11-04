<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Global functions for the mod_teams plugin.
 *
 * @package   mod_teams
 * @copyright 2023, João Pedro <joao_p221@outlook.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Function is called when the activity creation form is submitted.
 * This function is only called when adding an activity and should contain any logic required to add the activity.
 *
 * @param stdClass $data
 * @param mod_teams_mod_form $mform
 * @return int
 */
function teams_add_instance(stdClass $data, mod_teams_mod_form $mform = null): int {
    global $DB;

    $data->timemodified = $data->timecreated;
    $cmid = $data->coursemodule;

    // TODO: create teams meeting

    $data->id = $DB->insert_record('page', $data);
    $DB->set_field('course_modules', 'instance', $data->id, array('id'=>$cmid));

    return $data->id;
}

/**
 * Function is called when the activity editing form is submitted.
 *
 * @param stdClass $data
 * @param mod_teams_mod_form $mform
 * @return bool
 */
function teams_update_instance(stdClass $data, mod_teams_mod_form $mform): bool {
    global $DB;

    $data->timemodified = time();

    // TODO: update meeting information

    return $DB->update_record('page', $data);
}

/**
 * Function is called when the activity deletion is confirmed.
 * It is responsible for removing all data associated with the instance.
 *
 * @param int $id
 */
function teams_delete_instance(int $id): bool {
    global $DB;

    if (!$meeting = $DB->get_record('teams', ['id'=>$id])) {
        return false;
    }

    // TODO: delete teams meeting

    return $DB->delete_records('teams', array('id'=>$meeting->id));;
}