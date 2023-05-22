<?php
if (is_user_in_role(wp_get_current_user(), 'attendee')) wp_redirect(home_url());

/**
 * Template Name: Manage Events Page
 */

get_header();

global $wpdb;
$events_table = $wpdb->prefix . "events";
$my_events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_organizer_id=" . get_current_user_id());
?>

<div class="events-table-con">
    <h2>My Events</h2>

    <div class="events-table">
        <table>
            <tr class="event-head">
                <th class="event-image">Event Image</th>
                <th class="event-details">Event Details</th>
                <th class="event-tbl-tickets">Tickets Bought</th>
                <th class="event-actions">Actions</th>
            </tr>
            <?php
            if (count($my_events) > 0) {
                foreach ($my_events as $event) {
            ?>

                    <tr>
                        <td>
                            <div class="event-img" style="background:url('<?php echo $event->e_image_url ?>'); background-position: center; background-size:cover"></div>
                        </td>
                        <td class="event-details">
                            <a href="<?php echo site_url('/attendees?id=' . $event->e_id) ?>">
                                <div class="event-name-date-time">
                                    <p class="event-name"><?php echo shorten_string($event->e_name, 40) ?></p>
                                    <p class="event-date-time"><?php echo style_date($event->e_date) . " at " . style_time($event->e_time) ?></p>
                                </div>
                            </a>
                        </td>
                        <td class="event-tbl-tickets"><span class="ed-d"><?php echo ((int)$event->e_capacity - (int)$event->e_tickets_remaining) . " / " . $event->e_capacity ?></span></td>
                        <td class="event-actions">
                            <div>
                                <a href="<?php echo site_url('/update-event?id=' . $event->e_id) ?>"><button title="Edit Event" class="app-btn edit-btn"><ion-icon name="create"></ion-icon></button></a>
                                <form action="" method="post">
                                    <input type="hidden" name="e_id" value="<?php echo $event->e_id ?>">
                                    <button title="Delete Event" class="app-btn delete-btn" type="submit" name="delete_event"><ion-icon name="trash-outline"></ion-icon></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="empty-row">You don't have any events</td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

</div>

<?php get_footer(); ?>