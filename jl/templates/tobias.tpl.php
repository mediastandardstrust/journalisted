<?php

/*
 * special case version of journo.tpl.php for Tobias Grubbe
 */

$tg_objs = array( 'TG_GU_No1_120410.swf',
    'TG_GU_No2_190410.swf',
    'TG_GU_No3_260410.swf',
    'TG_GU_No4_03_05_10.swf',
    'TG_Gu_No5_10_05_10.swf',
    'TG_Gu_No6_17_05_10.swf',
    'TG_TG_No1_24_05_10.swf',
    'TG_TG_No2_31_03_10.swf',
    'TG_TG_No3_07_06_10.swf',
    'TG_TG_No4_14_06_10.swf',
    'TG_TG_No5_21_06_10.swf',
    'TG_TG_No6_28_06_10.swf',
);


$episode = get_http_var( 'episode', sizeof($tg_objs) );
if( $episode<1 || $episode > sizeof($tg_objs) )
    $episode = sizeof($tg_objs);

$tg_file = $tg_objs[ $episode-1 ];

$MAX_ARTICLES = 5;  /* how many articles to show on journo page by default */


/* build up a list of _current_ employers */
$current_employment = array();
foreach( $employers as $emp ) {
    if( $emp['current'] )
        $current_employment[] = $emp;
}

/* list of previous employers (just employer name, nothing else) */
$previous_employers = array();
foreach( $employers as $emp ) {
    if( !$emp['current'] )
        $previous_employers[] = $emp['employer'];
}
$previous_employers = array_unique( $previous_employers );

?>

<?php if( $can_edit_page && $status != 'a' ) { ?>
<div class="not-public">
  <p><strong>Please Note:</strong>
  Your page is not yet publicly accessible.
  It will be switched on once you have <a href="/missing?j=<?= $ref ?>">added</a> five articles.
  </p>
</div>
<?php } ?>


<div class="main journo-profile">
<div class="head"></div>
<div class="body">


<div class="overview">
  <div class="head"><h2><a href="<?= $rssurl; ?>"><img src="/images/rss.gif" alt="RSS feed" border="0" align="right"></a><?= $prettyname; ?></h2></div>
  <div class="body">

    <div class="photo">
<?php if( $picture ) { ?>
      <img src="<?= $picture['url']; ?>" alt="photo" width="<?= $picture['width'] ?>" height="<?= $picture['height']; ?>" />
<?php } else { ?>
      <img width="135" height="135" src="/img/rupe.png" alt="no photo" />
<?php } ?>
  <?php if( $can_edit_page ) { ?> <a class="edit" href="/profile_photo?ref=<?= $ref ?>">edit</a><?php } ?>
    </div>

    <div class="fudge">
          Born - 1667. I am fully occupied writing Essays for the
          broadsheets and news webs, as well as in certain Speculative
          Undertakings, and in missions for Her Majestie’s Government of
          a secret nature. However it is a truth that it is easier to find
          Commissions than to be paid afterward for them
    </div> <!-- end fudge -->
    <div style="clear: both;"></div>

  </div>
</div>  <!-- end overview -->


<?php /* TAB SECTIONS START HERE */ ?>


<div class="tabs">
<ul>
<li><a href="#tab-work">Work</a></li>
<li><a href="#tab-bio">Biography</a></li>
<li><a href="#tab-contact">Contact</a></li>
</ul>
</div>


<div class="tab-content" id="tab-work">

<div class="">
  <div class="head"><h3>Tobias Grubbe's latest adventures - episode <?= $episode ?></h3></div>
  <div class="body">
    <br/>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="600" height="400">
<param name="movie" value="<?= $tg_file ?>">
<param name="quality" value="high">
<embed src="/tobias/<?= $tg_file ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="600" height="400"></embed>
</object>
    <div>
Episode:
<?php
for( $i=1; $i<=sizeof($tg_objs); ++$i ) {
    if( $i==$episode ) {
?><strong><?= $i ?></strong>&nbsp;&nbsp;&nbsp;<?php
    } else {
?><a href="/<?= $ref ?>?episode=<?= $i ?>"><?= $i ?></a>&nbsp;&nbsp;&nbsp;<?php
    }
}
?>
    </div>
    <br/>

  </div>
  <div class="foot"></div>
</div>

<div class="previous-articles">
  <div class="head">
    <h3>Recent articles</h3>
  </div>
  <div class="body">

  <ul class="art-list">

<?php $n=0; foreach( $articles as $art ) { ?>
    <li class="hentry">
        <h4 class="entry-title"><a class="extlink" href="<?= $art['permalink']; ?>"><?= $art['title']; ?></a></h4>
        <span class="publication"><?= $art['srcorgname']; ?>,</span>
        <abbr class="published" title="<?= $art['iso_pubdate']; ?>"><?= $art['pretty_pubdate']; ?></abbr>
        <?php if( $art['buzz'] ) { ?> (<?= $art['buzz']; ?>)<?php } ?><br/>
        <?php if( $art['id'] ) { ?> <a href="<?= article_url($art['id']);?>">More about this article</a><br/> <?php } ?>
    </li>
<?php ++$n; if( $n>=$MAX_ARTICLES ) break; } ?>
<?php if( !$articles ) { ?>
  <p>None known</p>
<?php } ?>

  </ul>

<?php if($more_articles) { ?>
  (<a href="/<?= $ref ?>?allarticles=yes">Show all articles</a>)
<?php } ?>

  </div>
  <div class="foot"></div>
</div>




</div> <!-- end work tab -->




<div class="tab-content bio" id="tab-bio">


<div id="experience" class="experience">
  <div class="head">
    <h3>Experience</h3>
  </div>
  <div class="body">
    <ul class="bio-list">
      <li><h4>Apren-ticed to the Counting House of Lord Aitchboss</h4></li>
      <li><h4>Clerk to the Counting House of Lord Aitchboss</h4></li>
    </ul>
  </div>
</div>


<div class="education">
  <div class="head">
    <h3>Education</h3>
  </div>
  <div class="body">
    <ul class="bio-list">
      <li>
        <h4>I went to School, where I learned some Latin, some Numbers and many Letters</h4>
      </li>
    </ul>
  </div>
</div>


<div class="books">
  <div class="head">
    <h3>Books by <?= $prettyname ?></h3>
  </div>
  <div class="body">
    <ul class="bio-list">
      <li>
        <h4>The Concealed Truth Concerning Global Cooling and Sundry other Conspiracies</h4>
        (Printed by <i>Master Bullstrode</i>, at the Sign of the Saracen's Cheek, St Paul's.)
      </li>
    </ul>
  </div>
</div>


<div class="awards">
  <div class="head">
    <h3>Awards won</h3>
  </div>
  <div class="body">
    <p class="not-known">Tobias Grubbe hasn't won any awards</p>
  </div>
</div>



</div> <!-- end bio tab -->



<div class="tab-content contact" id="tab-contact">


<div class="">
  <div class="head">
    <h3>The authors of Tobias Grubbe</h3>
  </div>
  <div class="body">
    <p>
        Matthew Buck and Michael Cross<br/>
        &copy; All rights reserved
    </p>
  </div>
</div>


<div class="">
  <div class="head">
    <h3>The patron of Tobias Grubbe</h3>
  </div>
  <div class="body">
      <p>
    journa<i>listed</i>.com<br/>
    For more information contact <?= SafeMailto( "team@journalisted.com", "the journa<i>listed</i> team" );?>
      <br/>
      +44 20 7727 5252
    </p>
  </div>
</div>


</div> <!-- end contact tab -->
</div> <?php /* end main body */ ?>
<div class="foot"></div>
</div> <!-- end main -->




<div class="sidebar">

<a class="donate" href="http://www.justgiving.com/mediastandardstrust">Donate</a>

<div class="box subscribe-newsletter">
  <div class="head"><h3>journa<i>listed</i> weekly digest</h3></div>
  <div class="body">
    <p>To receive the journa<i>listed</i> digest every Tuesday via email, <a href="/weeklydigest">subscribe here</a></p>
  </div>
  <div class="foot"></div>
</div>


<div class="box actions">
  <div class="head"><h3>What can you do on Journalisted?</h3></div>
  <div class="body">
  <br />
  <ul>
  <li><a href="/profile">Edit</a> your journa<i>listed</i> profile</li>
  <li><a href="/search?type=journo">Find</a> contact details for a journalist</li>
  <li><a href="/search?type=article">Search</a> over 2 million news articles</li>
  </div>
  <br />
  <div class="foot"></div>
</div>

<div class="box you-can-also">
  <div class="head"><h3>You can also...</h3></div>
  <div class="body">
    <ul>
      <li class="add-alert"><a href="/alert?Add=1&amp;j=<?= $ref ?>">Add <?= $prettyname ?>'s articles to my daily alerts</a></li>
      <li class="print-page"><a href="#" onclick="javascript:window.print(); return false;" >Print this page</a></li>
<?php /*      <li class="forward-profile"><a href="#">Forward profile to a friend</a></li> */ ?>
<?php if( !$can_edit_page ) { ?>
      <li class="claim-profile">
        <a href="/profile?ref=<?= $ref ?>">Are you <?= $prettyname ?>?</a></li>
<?php } ?>
    </ul>
  </div>
  <div class="foot"></div>
</div>


<div class="box links">
  <div class="head"><h3><?= $prettyname ?> on the web</h3></div>
  <div class="body">
<?php if( $links ) { ?>
    <ul>
<?php foreach( $links as $l ) { ?>
       <li><a class="extlink" href="<?= $l['url'] ?>"><?= $l['description'] ?></a></li>
<?php } ?>
    </ul>
<?php } else { ?>
  <span class="not-known">No links known</span>
<?php } ?>
  </div>
  <div class="foot">
    <?php if( $can_edit_page ) { ?>
    <a class="edit" href="/profile_weblinks?ref=<?= $ref ?>">edit</a>
    <?php } ?>
  </div>
</div>




<div class="box admired-journos">
 <div class="head"><h3>Journalists more popular than <?= $prettyname ?></h3></div>
 <div class="body">
<?php if( $admired ) { ?>
  <ul>
<?php foreach( $admired as $a ) { ?>
   <li><?=journo_link($a) ?></li>
<?php } ?>
  </ul>
<?php } else { ?>
  <span class="not-known"><?= $prettyname ?> has not added any journalists</span>
<?php } ?>
 </div>
 <div class="foot">
<?php if( $can_edit_page ) { ?>
  <a class="edit" href="/profile_admired?ref=<?= $ref ?>">edit</a>
<?php } ?>
 </div>
</div>

</div>
</div> <!-- end sidebar -->

