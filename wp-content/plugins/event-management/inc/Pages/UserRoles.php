<?php

/**
 * @package EventManagement
 */

namespace Inc\Pages;

class UserRoles
{
    public function register()
    {
        $this->create_organizer_role();
        $this->create_attendee_role();
    }

    public function create_organizer_role()
    {
        add_role(
            'organizer',
            'Organizer',
            [
                'read' => true,
                'edit_posts' => true,
                'delete_posts' => true,
                'edit_published_posts' => true,
                'delete_published_posts' => true
            ]
        );
    }
    public function create_attendee_role()
    {
        add_role(
            'attendee',
            'Attendee',
            ['read' => true]
        );
    }
}
