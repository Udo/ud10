<h2>Combat</h2>

<div class="quickstart">
<h3>QUICK JUMP</h3>
  <li><a href="#start">Starting Combat</a></li>
  <li><a href="#movement">Movement</a></li>
  <li><a href="#actions">Actions</a></li>
  <li><a href="#attack">Attack</a></li>
  <li><a href="#parry">Parry/Dodge</a></li>
  <li><a href="#damage">Dealing Damage</a></li>
</div>

<style>
h3 {
  margin-top: 32px;
}
</style>

<p>
  Combat in UD10 can be played with varying levels of detail, as deemed appropriate by the GM. While this set of rules 
  contains instructions for play with a combat map to visualize the position of characters and their surroundings, it is 
  not a required accessory for the execution of meaningful combat scenes. 
</p>

<h3>When To Do Combat</h3>
<p>
  The main usage of a combat system is certainly to provide a rule framework for any kind of conflict scenario where force 
  is being used. But because of the combat system's rules and mechanisms for tracking and handling spacial, temporal and 
  physics-related game scenarios, it can also be appropriate for other situations that are not in the strictest sense 
  combat-related. Ultimately, the GM decides whenever combat mode is to be used.   
</p>

<p>
  Generally speaking, UD10 tries to be "realistic" in a sense that combat is often a deadly endeavor for player characters
  and NPCs alike. In this, as in all other things, GM discretion is advised to bend the combat rules to whatever style
  of gameplay is preferred.
</p>

<h2>Preparations</h2>
<p>
  Before a fight can be played out, the GM needs to know the relevant stats for all NPCs that are going to be involved 
  in the situation. This may require a short period of preparation if those characters are being designed on demand. 
  Preparing NPCs stats or even generic templates for entire categories of similar NPCs will alleviate this need. 
</p><p>
  Also, before combat starts, the topography and the relative position of all parties needs to be determined by the GM. 
  To avoid confusion at this point, it can be helpful to always keep track of party formation during the normal course of
  play – so the positions of the player characters are clear once a combat breaks out. 
</p><p>
  If you are using a battle map, this is the time to place the units (characters, machines, opponents) on the map. For the 
  purpose of this instruction we will assume a standard combat grid map where each square represents a 1.5m wide zone 
  that can hold one normally sized being. 
</p>

<a name="start"></a>
<h2>Starting a Combat Round</h2>
<p>
  It is important to understand that much of the combat rules revolve either directly or indirectly around the concept of 
  representing a causal progression of events in time. For this purpose, the defining unit of measurement is the Combat Round. 
  A Combat Round is a granular amount of time where actions can be performed by all combatants, it is the metric and the 
  heartbeat of combat. In personal melee and ranged battles, a Combat Round correlates loosely to about 10 seconds of time. 
  The GM may modify this amount in accordance to the specific needs of the situation (for example, sea battles with large 
  vehicles should take a much larger amount of time per Combat Round). A battle or skirmish can last for any number of Combat Rounds. 
  The GM determines when to start Combat Round mode and also when to drop out of it. 
</p><p>
  As the GM announces the start of a new Combat Round, the temporal order of actions is determined first. For this purpose, 
  an Initiative roll is performed by all parties. The GM may decide to roll INI once for all NPCs, each group of NPCs, or even 
  every NPC by herself. To determine Initiative, a d10 is rolled, and the skill rating of the Initiative skill is added. The 
  entity with the highest result opens the round, after that, the character with the next lowest result can act, and so forth 
  – until everyone has performed their actions. When a Combat Round is finished, the GM announces the next round.
</p><p>
  For speedier gameplay, all characters involved in the last Combat Round should keep their rolled INI results and carry them 
  over to subsequent rounds instead of re-rolling them every time.
</p>

<h3>Courses of Action</h3>
<p>
  Unless situational reasons dictate otherwise, a character can do the following things each round:
  <ul>
    <li>moving</li>
    <li>performing an action</li>
    <li>performing a reaction</li>
    <li>performing one or more free actions (within reasonable limits)</li>
  </ul>
</p>

<a name="movement"></a>
<h2>Movement</h2>
<p>
  Once per combat round, a character can move. There are different types of movement available:<br/>
  <br/>
  <b>Instantaneous</b>: these moves do not require much time and can be executed instantly and without having an effect on the 
  other actions the character may perform during that round. Examples for instantaneous actions are: moving a single step 
  (1 field on the map), looking around, dropping a weapon.
</p><p>
  <b>Standard Movement</b>: a character can do a Standard Movement that does not take up all of her time and energy this round. 
  When chosing this mode of movement, the character can still perform another action immediately either before or after moving. 
  Standard movement involves: jumping over a medium-sized obstacle, walking, drawing a small weapon. The range of a character's 
  standard movement is usually 5 meters plus her STR attribute.
</p><p>
  <b>Full Movement</b>: when in full movement, the character cannot perform any other actions this round. During this mode, the 
  character may move up to two times as far as her standard movement distance per round. 
</p>

<h2>Free Actions</h2>
<p>
  Free actions are minor maneuvers that don't prevent the character from performing their main action this round.
  Examples for free actions would be:
  <ul>
    <li>exchanging a few words with someone</li>
    <li>moving one step</li>
    <li>crouching</li>
    <li>making a hand signal</li>
  </ul>
</p>

<a name="actions"></a>
<h2>Performing Actions</h2>
<p>
  In addition to a standard movement, every combatant can perform one action per combat round. An action is any short activity 
  that can be performed nearly instantly, such as: <br/>
  <ul>
    <li>attacking an opponent </li>
    <li>drawing and readying a weapon</li>
    <li>reloading a ranged weapon</li>
    <li>using or manipulating an item or tool</li> 
    <li>performing a skill action that can be completed within the combat round</li>
  </ul>
</p>

<a name="attack"></a>
<h3>Attacking</h3>
<p>
  The most common type of action during a combat round is the attack action. There are two different types of attack actions: hand-to-hand and ranged attacks. <br/>
  <br/>
  To perform an attack action, the appropriate skill check has to be successful. Additional modifiers to the skill are common, depending on the weapon's attack modifier („AM“) and other situational modifiers. If the skill check isn't successful against a given difficulty, it is assumed that the attack missed its target. The attack skill check's difficulty is calculated as follows:<br/>
  <pre>  opponent's Defense rating +/- modifiers</pre>
  Normally, an opponent has a Defense rating 10 plus her DEX attribute. However, the DEX attribute only applies when the attack can be anticipated. As such, it does not apply when the opponent is suprised, attacked from behind, or otherwise unable to foresee the move. 
</p>

  <h3>Defense Rating Modifiers (Examples)</h3>
  <? table(array(
    'small in stature'     => array('Modifier' => '+1'),
    'large in stature'     => array('Modifier' => '-1'),
    'immobilized'          => array('Modifier' => '-2 and DEX doesn\'t count'),
    'has a shield'     => array('Modifier' => '+2'),
  ), 'center'); ?>
  
  <h3>Attack Modifiers (Examples)</h3>
  <? table(array(
    'Ranged Combat: opponent is crouching'              => array('Modifier' => '-2'),
    'Ranged Combat: opponent is moving'                 => array('Modifier' => '-2'),
    'Ranged Combat: shooting while moving'              => array('Modifier' => '-4'),
    'Ranged Combat: after taking aim for 1 round'       => array('Modifier' => '+2'),
    'Ranged Combat: after taking aim for 2 rounds'      => array('Modifier' => '+4'),
    'Ranged Combat: bad visibility (i.e. fog)'          => array('Modifier' => '-2'),
    'Melee Combat: opponent on higher ground'           => array('Modifier' => '-2'),
  ), 'center'); ?>

<h3>Ranged Attacks</h3>
<p>
  Ranged attacks require an appropriate ranged weapon. A check against the Ranged Combat skill is performed to determine whether the attack hits its target. 
  When making a ranged attack roll, it is also important to know how far away the target is. Every ranged weapon has a designated range increment. 
  Targets within that range can be attacked normally. If a target is beyond this range, a cumulative one point penalty applies for every time the range increment is exceeded. <br/>
  <br/>
  Some ranged weapons can fire multiple shots during one attack. In this case, those alternative firing modes and their damage codes are described in the appropriate weapons table in the “Equipment” section. 
</p>

<h2>Reactions and Defense</h2>

<a name="parry"></a>
<h3>Parrying and Dodging</h3>
<p>
  If the attack is successful, the GM determines whether the opponent is eligible for a Parry attempt or whether it is maybe possible to dodge the attack. To Parry, a character has to have an appropriate weapon ready – also, only one Parry attempt per combat round is permitted under normal circumstances. Parry is a skill that is linked to the DEX attribute, so a character who does not have this skill can try to Parry by rolling an untrained check against his DEX rating. <br/>
  <br/>
  A Parry attempt is a comparative check. If the parry check's result is higher than the attack roll's result, the attack did not go through.
</p>

<h3>Taking Cover</h3>
<p>
  In certain situations, a character may have the option of using her environment for cover against enemy attacks. In this case, the GM assigns a cover rating depending on the situation. The cover is a bonus to the character's defense rating.<br/>
  <br/>
  In general, such modifiers are called the character's defense rating. Armor, shields and other circumstances may also influence this value.
</p>

<h3>Optional Rule: Body Zones</h3>
<p>
  If an attack on a character is successful, a roll needs to be made to determine which part of his body was hit by the attack so the corresponding protective effect of any armor can be applied. In order to do this, a d10 is used: 

<table align="center">
  <tr>
    <td valign="top"><img src="/img/bodyzones.png"/></td>
    <td valign="top"><pre style="text-align: center">

<b>01</b>: head


<b>02</b>: left arm        <b>03</b>: right arm


<b>04-06</b>: trunk



<b>7/8</b>: left leg <b>9/10</b>: right leg 
  </pre></td>
  </tr>
</table>
</p>

<a name="damage"></a> 
<h2>Determining The Damage</h2>
<p>
  The next thing we need to know is the amount of damage caused by the attack. Every weapon has a damage code 
  that tells us how to roll and calculate the damage points per attack. When not using the <i>body zones</i>, armor 
  protection is averaged from all body zones into one single statistic. Damage codes are weapon-specific and 
  usually contain a fixed amount of points plus a number of ten-sided dice. Whenever a ten comes up on a damage 
  roll, the die may be rolled again and the result is added up.
</p>
  
<h3>Armor Rating</h3>
<p>  
  If the victim of the attack has any protection or armoring, the amount of damage is lessened by the Armor 
  rating of the respective body zone that was hit. 
</p>
  
<h3>Optional Rule: Buffer</h3>
<p>
  Most armor protects their wearer not only from immediate physical harm due to penetrating injuries but 
  also ameliorates the effects of forceful impact. They have a characteristic called the <i>buffer</i>. Incoming 
  damage is first lessened by the armor rating, and the rest is converted into endurance point (EP) loss. 
  The victim only sustains damage to her HP when the buffer of the armor is exceeded. 
</p>

<h3>Constitution</h3>
<p>
  Next, the amount of damage of an attack is first lowered by the rating of the CON attribute. The remaining 
  damage value is subtracted from the character's current Hit Points. 
</p>

<h3>Summary: Taking Damage</h3>

<p>
  <ol>
    <li>roll the weapon damage</li>
    <li>subtract the armor rating</li>
    <li>optional: subtract the buffer, lessen victim's EP by that amount</li>
    <li>subtract the victim's CON attribute</li>
    <li>lessen the victim's HP by the remaining value</li>
  </ol>
</p>

<h3>Optional Rule: Armor Penetration</h3>
<p>
  Some weapons are better at overcoming armor than others. This can be expressed by the optional <i>penetration</i>
  score of a weapon. Armor is then made less effective by the penetration score of an attacker's weapon. If you're
  playing with the optional <i>buffer</i> rule, the weapon's penetration score is also subtracted from the buffer's
  value.
</p>

<h3>Optional Rule: Fleeing From Battle</h3>
<p>
  If a character turns their back and runs away from one or more melee combatants with whom she is currently engaged in combat, every one of those opponents gets an immediate free action to attack the fleeing character. 
</p>

<h3>Optional Rule: Retreat</h3>
<p>
  Instead of fleeing from a hand-to-hand combat situation, a character may also retreat during movement. Opponents do not get a free attack action when a character is retreating,
  however, doing the retreat costs a full round during which the character may do nothing else in order to successfully disengage from melee combat.
</p>













