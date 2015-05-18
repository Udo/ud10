<h2>Skills</h2>

<div class="quickstart">
<h4>Quick Start</h4> 
  When creating a new character you get <b>10</b> points for skills. Select any skills from the list below and distribute these points among them. Do not give more than 3 points to a single skill.
  <br/><br/>Alternatively, you may use a <a href="/rules-char">Skill Template</a> that contains a number of pre-selected skills.
</div>

<h3>What Are Skills?</h3>
<p>
  Like attributes, skills describe the character's capabilities. While there are only four attributes to signify the character's basic properties, 
  skills can vary widely in number and ratings to represent the learned or innate special abilities of a person. Every character knows at 
  least the Standard skills. Then, further skills can be acquired both at the time of character creation and later in the game. Every skill 
  starts with a rating of 1. 
</p>

<h3>Rolling Skill Checks</h3>
<p>
  Making skill checks is similar to checking against attributes.<br/>
  <br/>
  Skills usually correspond to an attribute, indicating that this attribute boosts the performance of that particular skill. The corresponding attribute to each skill is given in parentheses, like this:<br/>
  <pre>    Some Cool Skill [INT]</pre>
  To roll a skill check, add the skill's rating to the corresponding attribute rating, then roll a d10 and add this, too. The sum of these points is the result of the skill check. The GM will tell a player what minimum result is needed for the action to succeed.<br/>
</p>

<div class="example">
  For example, Rebecca the Ranger wants to sneak into an enemy outpost. She has the Move Silently [DEX] skill at 3 points and a DEX attribute of 3 points. The GM decides the difficulty for this task will be 14. Her player rolls the D10 and gets a 5. <br/>
  <br/>
  Adding the D10's result of 5 to the skill's rating of 3 and the DEX attribute of three, Rebecca only manages an 11.
  The task is not successful and Rebecca is seen by her adversaries as she tries to enter the compound undetectedly.
</div>

<img class="left" src="/img/ud10-rider.jpg"/>

<h3>Skill Tags</h3>
<p>
  Skill description headers may contain other tags besides the skills corresponding attribute in parentheses. Those tags help you identify specific properties of the skill at one glance. Here is a list of possible tags:
</p>

<h4>[Untrained]</h4>
<p>
  Skills tagged "untrained" can be performed even by characters who do not possess the skill at all. For the purpose of the individual skill check against such a skill, it is assumed that the character has a rating of zero. However, the corresponding attribute still counts when the check is made.
</p>

<h4>[Fatigue]</h4>
<p>
  Some skills are exhausting for the character to use. Unless otherwise stated, successfully performing a skill marked "fatigue" causes the character to lose 1 EP. 
</p>

<h4>[Specialization]</h4>
<p>
  A specialization skill is rarely used on its own, but commonly serves to provide a bonus to a certain other skill it is derived from. Specialization ratings cannot be higher than the rating of their parent skills.
</p>

<h4>[Pool]</h4>
<p>
  Pool type skills are not skills in their own right, but provide a pool of bonus points that can be applied to certain other skill checks. Players can decide to apply one or more points from a pool to these checks as they see fit, however those points are then spent and have to be regenerated over time. Usually, combat skill pools are regenerated between skirmishes.
</p>

<h2>List of Skills</h2>

<p>
  The GM is free to invent lots of additional skills as appropriate, so the following list is just an obvious preselection. check rolls against the special skills are made at the discretion of the GM. 
  The skills listed here are intended for contemporary or near-future world settings.
</p>

<?

  $skills['Melee Combat Skills'] = array(
  
    'Dual Weapons – Melee' => array(
      'tags' => 'STR',
      'desc' => "With this skill it is possible to use two single-handed hand-to-hand weapons simultaneously during a single attack action. Of course, each weapon has to be small enough so it can be used with one hand only. This skill covers the attack with the character's off hand. It is possibly to attack with both hands at once, incurring a penalty of -2 on both checks.
The rating of this skill cannot be higher than the character's normal hand-to-hand combat skill."),
  
    'Melee Combat' => array(
      'tags' => 'STR / untrained',
      'desc' => "This skill indicates the ability of the character to attack an opponent either with her bare hands or any hand-held direct-contact weapon. To successfully hit an opponent in battle, a check roll needs to be made against this skill. If it is successful, the opponent receives damage points according to the damage rating of the weapon used. 
The Hand-to-hand combat skill can also be used to determine the outcome of other non-combat-related hand-to-hand coordination tasks.",
      ),

    'Melee Pool' => array(
      'tags' => 'pool',
      'desc' => "The melee pool can be used to boost any melee combat skill roll or the damage caused by a melee attack. The pool regenerates between fights or at a rate of 1 per combat round spent doing nothing.",
      ),

    'Parry' => array(
      'tags' => 'untrained',
      'desc' => "A successful check against this skill can be used to parry an incoming hand-to-hand attack. For the parry attempt to be successful, the result has to be higher than the attack roll.",
      ),

    'Weapon Specialization' => array(
      'tags' => 'specialization of Melee Combat',
      'desc' => "The specialization skill allows a character to specialize in a certain type melee weapon, such as for example daggers, swords, staves, flails etc. It is possible to have multiple weapon specializations, each covering a different type of weapon. The rating of a weapon specialization cannot exceed the rating of the character's Melee Combat skill.",
      ),
  
  
    );

  $skills['Ranged Combat Skills'] = array(

    'Aim Pool' => array(
      'tags' => 'pool',
      'desc' => "The aim pool can be used to boost any ranged combat skill roll or the damage caused by a ranged attack. The pool regenerates between fights or at a rate of 1 per combat round spent doing nothing.",
      ),

    'Dual Weapons - Ranged' => array(
      'tags' => 'DEX',
      'desc' => "With this skill it is possible to use two single-handed ranged weapons simultaneously during a single attack action. Of course, each weapon has to be small enough so it can be used with one hand only.
This skill covers the attack with the character's off hand. It is possibly to attack with both hands at once, incurring a penalty of -2 on both checks.
The rating of this skill cannot be higher than the character's normal ranged combat skill. ",
      ),

    'Ranged Combat' => array(
      'tags' => 'DEX / untrained',
      'desc' => "With the ranged combat skill, a character can use any kind of firearm or ranged weapon. To successfully hit an opponent in battle, a check roll against this skill needs to be made. The ranged combat skill also be used to determine the outcome of other actions, such as catching a flying object in mid-air.",
      ),

    'Weapon Specialization' => array(
      'tags' => 'specialization of Ranged Combat',
      'desc' => "The specialization skill allows a character to specialize in a certain type ranged weapon, such as for example bows, pistols, submachine guns, rifles etc. It is possible to have multiple weapon specializations, each covering a different type of weapon. The rating of a weapon specialization cannot exceed the rating of the character's ranged combat skill.",
      ),

    );

  $skills['Athletic Skills'] = array(

    'Acrobatics' => array(
      'tags' => 'DEX',
      'desc' => "Allows the character to perform gymnastics and advanced movement maneuvers. A successful Acrobatics check can also reduce falling damage by half. ",
      ),

    'Athletic Pool' => array(
      'tags' => 'pool',
      'desc' => "This pool skill provides a buffer of points that can be used to raise a character's defense rating for one combat round, and it can be used to boost any skill belonging to the athletic group. The player must announce the number of points she wants to use to boost the defense rating at the character's initiative turn. The defense rating then stays boosted until the character's next action in the following combat round. The defense pool regenerates between fights or at a rate of 2 per combat round spent doing nothing.",
      ),

    'Endurance' => array(
      'tags' => 'CON / untrained',
      'desc' => "In a situation where the character might lose one or more endurance points, a check against the Endurance skill may be performed. If successful the loss of EP is halved if the check succeeds, but at minimum one EP is drained in any case. ",
      ),

    'Initiative' => array(
      'tags' => 'DEX / untrained',
      'desc' => "The initiative skill represents the character's ability to react swiftly in challenging situations. During a fight, each participant has to roll a d10 and add their initiative rating in order to determine when they can perform an action relative to the other participants. Simple check rolls on initiative can be performed to indicate readiness or quickness of a character's reaction in a crisis situation. ",
      ),

    'Swim' => array(
      'tags' => 'CON / untrained',
      'desc' => "Checks against this skill can be made to determine the outcome of swimming maneuvers. It is assumed that most people are adept enough at swimming to keep themselves afloat and moving even if they do not have the Swim skill.",
      ),

    );

  $skills['Science Skills'] = array(

    'Biology' => array(
      'tags' => 'INT',
      'desc' => "With this skill, the character can analyze and classify organisms, evaluate the behavior and physiology of organisms, perform and understand biological experiments.",
      ),

    'Chemistry' => array(
      'tags' => 'INT',
      'desc' => "The chemistry skill provides the character with theoretical and practical knowledge of chemical processes. She can also perform and understand chemical experiments and evaluations.  ",
      ),

    'Basic Knowledge' => array(
      'tags' => 'INT / untrained',
      'desc' => "The basic knowledge skill represents the character's general education level. Check rolls against this skill can be used to determine whether a character possesses any general contemporary piece of knowledge, though – like any roll - this check might get assigned a modifier by the GM to indicate the difficulty level. ",
      ),

    'First Aid / CPR' => array(
      'tags' => 'INT',
      'desc' => "Every time a person needs to be treated for injuries or even needs to be resuscitated, a check against this skill is performed. This skill also forms the basis for any advanced medical treatment.",
      ),

    'Mathematics' => array(
      'tags' => 'INT',
      'desc' => "With this skill, the character develops a profound understanding of the science of general physics and mathematics, as appropriate to the given campaign setting.",
      ),

    'Physics' => array(
      'tags' => 'INT',
      'desc' => "The character has an understanding of the guiding principles of physcis, as well as the mathematical underpinnings required to do advanced calculations based on them.",
      ),

    'Science Specialization' => array(
      'tags' => 'specialization of any science skill',
      'desc' => "This specialization allow a character to become competent at more profound areas of scientific research and practice, for example medical treatment is a specialization of first aid and medical diagnosis is a specialization of biology.",
      ),

    );


  $skills['Technical Skills'] = array(

    'Electrical Engineering ' => array(
      'tags' => 'INT',
      'desc' => "With this skill, a character can operate, understand, control, repair, and modify electrical and electronic equipment. ",
      ),

    'Information Systems' => array(
      'tags' => 'INT',
      'desc' => "With this skill, a character can operate, understand, control, repair, and modify IT equipment such as computer hardware, software, network components, etc. ",
      ),

    'Mechanics' => array(
      'tags' => 'DEX',
      'desc' => "With this skill, a character can operate, understand, control, repair, and modify mechanical equipment.",
      ),

    'Navigation' => array(
      'tags' => 'INT',
      'desc' => "This skill indicates theoretical knowledge regarding the making and reading of cartographic material, as well as the handling of navigation equipment.",
      ),

    'Occupational Skill' => array(
      'tags' => 'usually INT or DEX',
      'desc' => "The Occupational Skill represents the character's formal training in a certain area. A character can acquire multiple occupational skills, each has to be named specifically according to the work that is being performed. Examples for occupational skills are: construction worker, craftsman, office clerk etc.",
      ),

    );


  $skills['Social Skills'] = array(

    'Diplomacy' => array(
      'tags' => 'INT / untrained',
      'desc' => "Especially useful in crisis situations, this skill provides the basic framework for guided discussion, persuasion, and general politics.",
      ),

    'Etiquette' => array(
      'tags' => 'INT / untrained',
      'desc' => "This skill indicates the knowledge of a character about how to follow certain social behavioral codes as well as her general inclination to do so. ",
      ),

    'Rules and Regulations' => array(
      'tags' => 'INT',
      'desc' => "A character with this skill knows a lot about the law and other regulations pertaining to his usual social environment. ",
      ),

    'Speak Language' => array(
      'tags' => 'INT',
      'desc' => "This skill represents knowledge in a spoken language of choice.",
      ),

    'Psychology' => array(
      'tags' => 'INT',
      'desc' => "This skill indicates theoretical psychological knowledge.",
      ),

    'Religion' => array(
      'tags' => 'INT',
      'desc' => "This skill indicates theoretical religious and related cultural knowledge.",
      ),

    'Social Specialization' => array(
      'tags' => 'specialization of any Social Skill',
      'desc' => "This allows a character to specialize in any area of a social skill described in this section.",
      ),

    'Flirting' => array(
      'tags' => 'DEX / untrained',
      'desc' => "The flirting skill applies to all attempts at improving social contact through sexual innuendo or otherwise flirty advances.",
      ),
    );

  $skills['Military Skills'] = array(

    'Hide' => array(
      'tags' => 'DEX / untrained',
      'desc' => "To hide herself, other people, or objects from unwanted discovery, checks against this skill are performed. ",
      ),

    'Military Tactics' => array(
      'tags' => 'DEX',
      'desc' => "This skill provides additional expertise for use in military combat situations, especially where team play is required. ",
      ),

    'Quick Draw' => array(
      'tags' => 'DEX',
      'desc' => "To draw a weapon as a free action, the character makes a check against her Quick Draw skill. The difficulty for
                 this is 10 for small weapons, 15 for medium weapons, and 20 for large weapons. For modern automatic weapons,
                 the difficulty rises by 5 points to load a cartridge into the chamber (but switching the safety off is free).
                 Readying a shield in addition to a melee weapon also raises the difficulty by 5.
                 The GM is free to apply additional situational modifiers. If the check is unsuccessful, the maneuver takes up
                 a normal action.",
      ),

    'Move Silently' => array(
      'tags' => 'DEX / untrained',
      'desc' => "Checks against this skill can be performed to determine the outcome of the character's attempt at silent movement. ",
      ),

    'Search' => array(
      'tags' => 'INT / untrained',
      'desc' => "Checks against this skill can be performed to search an area for certain items or characteristics.",
      ),

    'Survival' => array(
      'tags' => 'DEX',
      'desc' => "The Survival skill represents a character's ability to survive independently in the wilderness.",
      ),

    'Tracking' => array(
      'tags' => 'DEX',
      'desc' => "With this skill, a character can follow the trail of one or more creatures, provided they left minimal physical evidence. The rating of this skill cannot exceed the rating of the character's survival skill. ",
      ),

    );

  $skills['Piloting Skills'] = array(

    'Riding' => array(
      'tags' => 'DEX',
      'desc' => "With this skill, a character can ride a specially trained animal, such as a horse.",
      ),

    'Drive Cars / Ground Vehicles' => array(
      'tags' => 'DEX',
      'desc' => "This skill allows a character to pilot a range of ground vehicles appropriate to the campaign setting, such as automobiles, carriages, hovercraft etc.",
      ),

    'Pilot Aircraft' => array(
      'tags' => 'DEX',
      'desc' => "The aircraft piloting skill qualifies a character to fly a number of aircraft appropriate to the campaign setting.",
      ),

    'Pilot Spacecraft' => array(
      'tags' => 'DEX',
      'desc' => "The aircraft piloting skill qualifies a character to fly a number of spacefaring craft appropriate to the campaign setting. Note that this skill only applies to maneuvering spacecraft in vacuum and low-gravity environments. For piloting them in atmospheres, the aircraft piloting skill is necessary.",
      ),

    'Vehicle Specialization' => array(
      'tags' => 'specialization of any piloting skill',
      'desc' => "Piloting specialization can be used to represent further training a character has with a certain type of vehicle.",
      ),

    );

  ksort($skills);
  
?>
  <div class="toc">
    <h4>Quick Jump</h4> 
    <ul>
    <? foreach($skills as $sn => $s) { $sl[] = '<li><a href="#'.md5($sn).'">'.$sn.'</a></li>'; }
    print(implode(' ', $sl));
    ?>  </ul>
  </div>

<?
  
  foreach($skills as $skillGroupName => $group)
  {
    ksort($group);
    ?>
    <a name="<?= md5($skillGroupName) ?>"></a>
    <h3><?= $skillGroupName ?></h3><?
    foreach($group as $skillName => $info)
    {
      ?><p>
        <div class="qinfo">[<?= $info['tags'] ?>]</div>
        <div><b><?= $skillName?></b></div>
        <?= (str_replace(chr(10), chr(10).chr(10), $info['desc'])) ?>
      </p><?
    }
  }

?>










