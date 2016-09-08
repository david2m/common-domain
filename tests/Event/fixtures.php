<?php
class UserSignedUp
{

}

class SendEmailOnUserSignup
{

    public function onSignup(UserSignedUp $event)
    {

    }

}

class AddUserToMailingListOnSignup
{

    public function onSignup(UserSignedUp $event)
    {

    }

}

class OrderShipped
{

}

class SendEmailOnOrderShipped
{

    public function onOrderShipped(OrderShipped $event)
    {

    }

}

class AddToMessageQueueOnEvent
{

    public function onEvent($event)
    {

    }

}