<img class="right" src="/img/ud10-face.jpg"/>

<h2>Making a Character</h2>

<p>
  This section describes how to quickly create a character. If you want to play one of the
  UD10 <a href="/settings">settings</a>, you should refer to the character creation rules there.
</p><p>
  1 - First, write down the 4 <a href="/rules-attributes">attributes</a>: 
  STR, DEX, CON, and INT. All of those have a rating of zero points. You may now distribute 5 points 
  among those, but no single attribute may be higher than 3.
</p><p>
  2 - Now it's time for the <a href="/rules-health">health status scores</a>: HP, EP, or MS. They start at 10 
  each. You may distribute another 5 points among those, but no more than 3 points per status score.
</p><p>
  3 - You probably want to decide beforehand what your character is supposed to be like. Decide on a job, or any 
  stereotype you might want to realize here. Keep this in mind when distributing your points. You can refer to 
  the stereotypical dispositions further down on this page.
</p><p>
  4 - While it is up to the GM to decide how many points you get to spend in order to create your character, 
  you now normally get 10 points to buy <a href="/rules-skills">skills</a>. Each point gets you a new skill 
  or raises an existing skill by 1. To ensure new characters are balanced, no skill may exceed a rating of 3 
  during character creation though.
</p><p>
  For writing down a character, you can print out and use this character sheet: 
  [<b><a href="/dl/UD10 2 Character Sheet Blue.pdf">PDF</a></b>] 
  [<b><a href="/dl/UD10 2 Character Sheet Blue.odt">ODT</a></b>] - but a blank piece of paper works equally well.
</p>

<h3>Dispositions</h3>

<p>Here is a list of dispositions that may fit your character, you may choose one from each category:</p>

<div style="column-count:4;-moz-column-count:4;-webkit-column-count:4;">
<p>
  <b>Wealth</b>
  <li>independently wealthy</li>
  <li>high-earning</li>
  <li>moderately wealthy</li>
  <li>mobile</li>
  <li>average</li>
  <li>poor</li>
</p>

<p>
  <b>Outlook</b>
  <li>enterprising</li>
  <li>conservative</li>
  <li>liberal</li>
  <li>opportunistic</li>
  <li>obedient</li>
  <li>commanding</li>
</p>

<p>
  <b>Social Prowess</b>
  <li>socially active</li>
  <li>well-connected</li>
  <li>individualistic</li>
  <li>back-stabbing</li>
  <li>solitary</li>
  <li>antisocial</li>
</p>

<p>
  <b>Mental Resourcefulness</b>
  <li>improviser</li>
  <li>thinker</li>
  <li>achiever</li>
  <li>dullard</li>
  <li>chaotic</li>
  <li>underachiever</li>
</p>
</div>

<img class="right" src="/img/ud10-siege2.jpg"/>

<h3>Applying Templates</h3>
<p>
  Templates are pre-fabricated archetypes that can be applied to your character, depending on the setting you're playing in. 
  Choosing a template will cost a number of points that you would otherwise spend on acquiring skills.
  A template will contain a set of bonuses to attributes and skills that your character gets to start with. 
  Bonus points from templates are applied after the freely assignable experience points for character generation are spent. <br/>
  <br/>
  What templates are available depends on the setting you want to play in (the same applies to the selection of skills). In this part of the rulebook,
  we supply a few templates for making characters suitable for a contemporary, non-fantasy setting - in other words: templates for people you can find on any street today.
</p>

<?

$templates['Banker'] = array(
  'scores' => 'INT +1, Rules&Regulations +4, Mathematics +1, Occupational Skill: Banking +2, Flirting +1',
  'desc' => '',
  );

$templates['Hacker'] = array(
  'scores' => 'INT +2, Information Systems +4, Mathematics +1, Occupational Skill: Programming +2, Basic Knowledge +1',
  'desc' => '',
  );

$templates['Hipster'] = array(
  'scores' => 'DEX +1, Information Systems +1, Speak Language (pick one) +2, Flirting +2, Etiquette +1',
  'desc' => '',
  );

$templates['Law Enforcement Officer'] = array(
  'scores' => 'DEX +1, CON +1, Drive Cars +2, Initiative +2, Rules&Regulations +1, Occupational Skill: Policework +2, Ranged Combat +1',
  'desc' => '',
  );

$templates['Soldier'] = array(
  'scores' => 'CON +1, STR +1, Pilot Ground Vehicles +1, Occupational Skill: Military +2, Ranged Combat +2, Military Tactics +2, Athletic Pool +2',
  'desc' => '',
  );

$templates['Teacher'] = array(
  'scores' => 'INT +1, Occupational Skill: Teaching +2, Basic Knowledge +4, One Science Skill +2, One Social Skill +2',
  'desc' => '',
  );

$templates['Street Thug'] = array(
  'scores' => 'STR +2, Initiative +1, Melee Combat +2, Ranged Combat +1, Flirting +1, Occupational Skill: Streetwise +2',
  'desc' => '',
  );

$templates['Political Activist'] = array(
  'scores' => 'DEX +1, Melee Combat +2, Basic Knowledge +2, Rules&Regulations+1, Psychology +1',
  'desc' => '',
  );

$templates['Sport Student'] = array(
  'scores' => 'STR +1, CON +1, DEX +1, Flirting +2, Occupational Skill: Sports Knowledge +1, Acrobatics +2, Swim +2',
  'desc' => '',
  );

$templates['PoliSci Student'] = array(
  'scores' => 'INT +1, Basic Knowledge +2, Diplomacy +2, Etiquette +2, Psychology +1, Occupational Skill: Politics +2',
  'desc' => '',
  );

$templates['Pilot'] = array(
  'scores' => 'DEX +2, Pilot Aircraft +4, Flirting +2, Navigation +1, Occupational Skill: Airline Pilot +2',
  'desc' => '',
  );

$templates['Driver'] = array(
  'scores' => 'DEX +1, Initiative +1, Navigation +2, Driving Cars +4, Mechanics +1',
  'desc' => '',
  );

$templates['Security Guard'] = array(
  'scores' => 'STR +1, Athletic Pool +1, Endurance +1, Melee Combat +2, Melee Pool +2, Search +2, Ranged Combat +1',
  'desc' => '',
  );

$templates['Office Drone'] = array(
  'scores' => 'Information Systems +2, Flirting +2, One Language +2, Occupational Skill: Bureaucracy +2, Diplomacy +2, Occupational Skill: Internet Memes +2',
  'desc' => '',
  );

$templates['Intelligence Analyst'] = array(
  'scores' => 'INT +2, Occupational Skill: Intelligence +2, Ranged Combat +1, Information Systems +2, Basic Knowledge +2, One Language +1, Military Tactics +1',
  'desc' => '',
  );

$templates['Archeologist'] = array(
  'scores' => 'INT +1, DEX +1, Occupational Skill: History +4, Search +2, One Social Skill +2, Navigation +1',
  'desc' => '',
  );

$templates['Translator'] = array(
  'scores' => 'One Language +4, One Language +2, One Language +1, Diplomacy +2, Psychology +1, Etiquette +1',
  'desc' => '',
  );

$templates['Social Worker'] = array(
  'scores' => 'Drive Cars +1, Basic Knowledge +1, Diplomacy +2, Etiquette +1, Psychology +2, Religion +1, Rules&Regulations +2',
  'desc' => '',
  );

$templates['Mechanic'] = array(
  'scores' => 'DEX +1, Drive Cars +1, Electrical Engineering +2, Occupational Skill: Repair +2, Mechanics +4',
  'desc' => '',
  );

$templates['Research Scientist'] = array(
  'scores' => 'INT +1, Basic Knowledge +2, Information Systems +1, One Science Skill +4, One Science Skill +1, One Science Specialization +2',
  'desc' => '',
  );

$templates['Nurse'] = array(
  'scores' => 'Initiative +1, First Aid/CPR +4, Occupational Skill: Medical Care +4, Diplomacy +1, Psychology +1',
  'desc' => '',
  );

$templates['Medical Doctor'] = array(
  'scores' => 'INT +1, First Aid/CPR +4, Occupational Skill: Surgery +2, Occupational Skill: Medical Diagnosis +4',
  'desc' => '',
  );

ksort($templates);

?><div class="example">
<h2>Contemporary Archetypes (Examples)</h2><?
foreach($templates as $tn => $ti)
{
  $cost = 0;
  $sklz = array(); $skillz = array();
  $sc = explode(',', $ti['scores']);
  foreach($sc as $sli)
  {
    $slk = trim(CutSegment('+', $sli));
    if(strlen($slk) <= 3) 
    {
      $slk = '0'.$slk;
      $cost += $sli;
    }
    $sklz[] = $slk.' +'.$sli;
    $cost += $sli; 
  }
  sort($sklz);
  foreach($sklz as $sli) 
    if(substr($sli, 0, 1) == '0') $skillz[] = substr($sli, 1); else $skillz[] = $sli;
  ?><p>
    <h4><?= $tn ?> <span style="font-weight: normal;">(Cost: <?= floor($cost*0.75) ?>)</span></h4>
    <div class="wqinfo"><?= implode(', ', $skillz) ?></div>
    <div><?= $ti['desc'] ?></div>
  </p><? 
}

?></div>


<h3>Making Your Own Templates</h3>
<p>
  Templates are a good way to emulate the classical "character classes" found in many roleplaying systems.
  To encourage players to base their characters on a template while still giving them complete freedom,
  the point sums provided by templates are a bit cheaper than they would be if you created a similar character
  from scratch. As a rule of thumb, add the skill points of a template together, then add the double of
  all attribute bonus points and take 75% of the resulting sum as the cost for that template:
  <pre>
    Template cost = [(sum of skill points) + (2 x sum of attribute bonuses)] * 0.75
  </pre>
</p>

