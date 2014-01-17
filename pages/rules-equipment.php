<h2>Weapons And Equipment Guide</h2>

<div class="quickstart">
<h3>QUICK JUMP</h3>
  <li><a href="#melee">Melee Weapons</a></li>
  <li><a href="#ranged">Ranged Weapons</a></li>
  <li><a href="#armor">Armor</a></li>
  <li><a href="#military">Military Equipment</a></li>
</div>

<p>
  This equipment guide is intended for contemporary scenarios. Equipment lists for futuristic, historical, or
  sword & sorcery backgrounds will be supplied when the respective settings modules come out. In the mean time,
  GMs can easily improvise their own equipment if needed. As with everything else in the rulebook, this is
  merely a suggestion.
<p>

<a name="melee"></a>
<h3>Melee Weapons</h3>

<p>
  Some kinds of melee weapons are easier to handle than others. The Attack Modifier (AM) value indicates
  a bonus or penalty to the character's Melee Combat skill when using a given weapon.
  Melee weapons are categorized by the damage type they deal. In this list, we have blunt, slashing, piercing, and crushing weapons.<br/>
  <br/>
  <b>Blunt weapons</b> are considered non-lethal during normal use. They deal their damage not to the characters Hit Points, but her Endurance Points (EP) instead.
  In addition to that, they cause half that damage to HP. <br/>
  <br/>
  <b>Crushing weapons</b> are good against older types of rigid armor such as hardened leather or armor plates.
  These types of armor are one point less efficient when dealing with crushing weapons.<br/>
  <br/>
  <b>Piercing weapons</b> have more impact against opponents wearing mesh-like protection, such as chain mail;
  these types of armor are one point less efficient against piercing weapons.<br/>
  <br/>
  <b>Slashing weapons</b> deliver the full inertia of the weapon through a very sharp edge. 
  They cause one additional point of damage when attacking an opponent with no armor. 
</p>

<?

table(array(
  
  '(Unarmed Attack)'    => array('AM' => '0', 'Damage' => 'D5 + STR',     'Penetration' => ''),
  'Dagger / Long Knife' => array('AM' => '-4', 'Damage' => 'D10 + STR',   'Penetration' => ''),
  'Short Sword'         => array('AM' => '0', 'Damage' => 'D10 + STR*2', 'Penetration' => ''),
  'Long Sword'          => array('AM' => '-4', 'Damage' => 'D10 + STR*3', 'Penetration' => ''),
  'Longstaff'           => array('AM' => '0', 'Damage' => 'D10 + STR*2',  'Penetration' => '-1'),
  'Baton'               => array('AM' => '0',  'Damage' => 'D10 + STR',   'Penetration' => '-1'),
  'Mace'                => array('AM' => '0', 'Damage' => 'D10 + STR*2',  'Penetration' => ''),
  'Flail'               => array('AM' => '-4', 'Damage' => 'D10 + STR*3', 'Penetration' => ''),
  'Rapier'              => array('AM' => '0', 'Damage' => 'D10 + STR',    'Penetration' => '+1'),
  'Bayonet'             => array('AM' => '-4', 'Damage' => 'D10 + STR',   'Penetration' => ''),

  ), 'right,left,center');

?>

<a name="ranged"></a>
<h3>Ranged Weapons</h3>

<p>
  The following weapons are generic contemporary ranged weapons without any specific model description. The GM is welcome
  to use this general table to design specific firearm models that match their historic counterparts more accurately. 
  "AM" is the attack modifier of the weapon. Damage refers to the damage caused by a firing mode. If a weapon has more
  than one firing mode, the damage ratings are separated by commata. Range refers to the designated range increment of the weapon (see also "range" under 
  <a href="/rules-combat">combat</a>). Rifle-type weapons have a second range increment value which refers to the
  effective range increment if the weapon is mounted on a tripod or rests on the ground as the user is in a mostly
  immobile firing position - however the AM is lowered in this mode if the target is moving.
  "Short" and "long" refer to the ammunition expended during a short or long burst.
</p>

<?

table(array(

  'Bow'                 => array('AM' => '-4', 'Damage' => 'D10+STR', 'Penetration' => '+2',   'Range' => '5m', 'Mag' => '1',       
                                 'Short' => '', 'Long' => ''),
  'Crossbow'            => array('AM' => '-',  'Damage' => 'D10+2',   'Penetration' => '+2',   'Range' => '5m', 'Mag' => '1',       
                                 'Short' => '', 'Long' => ''),
  'Light Handgun'       => array('AM' => '-',  'Damage' => 'D10+1',   'Penetration' => '',   'Range' => '3m', 'Mag' => '15',        
                                 'Short' => '', 'Long' => ''),
  'Heavy Handgun'       => array('AM' => '-',  'Damage' => 'D10+4',   'Penetration' => '',   'Range' => '3m', 'Mag' => '8',         
                                 'Short' => '', 'Long' => ''),
  'Submachine Gun'      => array('AM' => '-',  'Damage' => 'D10+1',   'Penetration' => '',   'Range' => '3m', 'Mag' => '15, 30',        
                                 'Short' => '3', 'Long' => '10'),
  'Shotgun (double barrel)'     => array('AM' => '+2', 'Damage' => 'D10+10-distance', 'Penetration' => '-1', 'Range' => '3m', 'Mag' => '2', 
                                 'Short' => '2', 'Long' => ''),
  'Assault Rifle'       => array('AM' => '-2', 'Damage' => 'D10+4',   'Penetration' => '+2',   'Range' => '10m/30m', 'Mag' => '5, 20, or 30',
                                 'Short' => '3', 'Long' => '10'),
  'Rifle'               => array('AM' => '-2', 'Damage' => 'D10+4',   'Penetration' => '+2',   'Range' => '10m/40m', 'Mag' => '5, 20, or 30',
                                 'Short' => '', 'Long' => ''),
  'Sniper Rifle'        => array('AM' => '-4', 'Damage' => 'D10+6',   'Penetration' => '+3',   'Range' => '10m/50m', 'Mag' => '1, or 5',
                                 'Short' => '', 'Long' => ''),

  ), 'right,left,center,left,left');


?>

<h4>Firing Modes</h4>

<p>
  Many modern military weapons are capable of full automatic firing modes. Mapped to the table above, the handguns and
  the rifle are also available as full automatic variants.
</p><p>

  <b>Rapid fire</b>: Semi-automatic weapons or full automatic weapons switched to
  single-shot mode can be fired in rapid succession. This allows the user to shoot twice per combat round if they
  do not perform a movement action in the same round.
</p><p>

  <b>Short burst</b>: Automatic weapons which have a <i>short burst</i> capability (denoted by the "Short" column above),
  can fire as many bullets in a single attack as stated. The attack is made with a penalty of -2. For every 2 points
  the attack roll comes <i>above</i> the target's defense rating, an additional bullet hits (up to the number
  of bullets fired).
</p><p>

  <b>Long burst</b>: Automatic weapons which have a <i>long burst</i> capability (denoted by the "Long" column above),
  can fire as many bullets in a single attack as stated. The attack is made with a penalty of -4. For every 2 points
  the attack roll comes <i>above</i> the target's defense rating, an additional bullet hits (up to the number
  of bullets fired). An attacker can also choose to spread the long burst attack evenly among a group of up to
  three targets that are close to each other. 
</p><p>

  <b>Suppression fire</b>: An attacker can use this action to lay down suppression fire in order to keep
  a group of targets from leaving their cover positions. Suppression fire uses up the number of bullets equal to the
  <i>long burst</i> firing mode of the weapon. 
  Until the attacker's next action in the coming combat round, every person who is pinned down by suppression
  fire must make a successful DEX check against a 10 to do anything that requires emerging from cover.
  If someone does emerge from cover, the attacker makes an automatic attack roll to hit them with a single
  bullet as a free action.
</p>

<a name="armor"></a>
<h3>Armor</h3>

<p>
  Armor is available for different body zones. The "penalty" value below refers to a penalty on
  all acrobatic actions (including melee combat) when wearing the armor.
</p>

<?

table(array(

  'Sturdy clothes'    => array('Armor' => '1',  'Buffer' => '1',  'Penalty' => '0'),
  'Studded leather'   => array('Armor' => '2',  'Buffer' => '2',  'Penalty' => '0'),
  'Chain mail*'       => array('Armor' => '4',  'Buffer' => '2',  'Penalty' => '-4'),
  'Plate Armor'       => array('Armor' => '6',  'Buffer' => '4',  'Penalty' => '-4'),
  'Kevlar'            => array('Armor' => '6',  'Buffer' => '8',  'Penalty' => '-2'),
  'Blast Suit'        => array('Armor' => '8',  'Buffer' => '10', 'Penalty' => '-8'),

  ), 'center,center,center', array('nosort' => true));

?>

<p>
  *: Chain mail does not provide protection against ranged weapons.
</p>



<a name="military"></a>
<h3>Military Equipment</h3>

<?

$equipment = array(

  'Targeting laser'      => array('desc' => 'By attaching a targeting laser onto a ranged weapon, the attacker gains a +2 bonus to her attack roll.'),
  'Targeting scope'      => array('desc' => 'Some weapons can be fitted with an optical targeting scope. When using the scope to attack, the weapon\'s range increments are doubled.'),
  'Passive night vision' => array('desc' => 'Night vision goggles or night vision binoculars enable the user to see under extreme low-light conditions.'),
  'Flash light'          => array('desc' => 'Flash lights are essential outdoor survival gear that allows the user to project a cone of light at will.'),
  
  );

ksort($equipment);

foreach($equipment as $caption => $p)
{
  ?><p>
  
    <h4><?= htmlspecialchars($caption) ?></h4>
    <?= htmlspecialchars($p['desc']) ?>
  
  </p><?
}

?>















