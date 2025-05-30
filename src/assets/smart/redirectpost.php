
<form id="ltiPOST" action="https://smart-dev.cehd.gsu.edu/SMART/dashboardTest" method="post">
     <input type="hidden" name="given_name" value="<?php echo $message->user->givenName; ?>">
     <input type="hidden" name="family_name" value="<?php echo $message->user->familyName; ?>">
     <input type="hidden" name="name" value="<?php echo $message->user->name; ?>">
     <input type="hidden" name="email" value="<?php echo $message->user->email; ?>">
    <input type="hidden" name="user_id" value="<?php echo $message->brightspace->userID; ?>">

     <input type="hidden" name="course_id" value="<?php echo $message->context->id; ?>">
    <input type="hidden" name="title" value="<?php echo $message->resourceLink->title; ?>">

    <input type="hidden" name="Launch_ID" value="<?php echo $message->launchID; ?>">
    <input type="hidden" name="GUID" value="850F7C53-50F0-471D-A9EA-B1A6D87098E1">
    <input type="hidden" name="course_title" value="<?php echo $message->context->title; ?>">
    <input type="hidden" name="assignment_title" value="<?php echo $message->resourceLink->title; ?>">


    <input type="hidden" name="https://purl.imsglobal.org/spec/lti/claim/roles" value="
    <?php
    for ($i = 0; $i < count($message->roles); $i++) {
        echo $message->roles[$i];
        echo " ";
    }
    ?>
    ">
    </form>

    
   <script type="text/javascript">
        document.getElementById('ltiPOST').submit();
    </script>