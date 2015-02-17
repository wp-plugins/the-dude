<?php
/**
 * @package The_Dude
 * @version 0.2
 */
/*
Plugin Name: The Dude
Plugin URI:
Description: That, or His Dudeness… Duder… or El Duderino, if, you know, you're not into the whole brevity thing.
Author: Kostas Vrouvas
Version: 0.2
Author URI: http://kosvrouvas.com/
*/

function the_dude_get_lyric() {
	/** Quotes from the movie */
	$lyrics = "That rug really tied the room together.
You're Mr. Lebowski. I'm the Dude.
That, or His Dudeness… Duder… or El Duderino, if, you know, you're not into the whole brevity thing.
Obviously you're not a golfer.
Yeah, well. The Dude abides.
Is this a... what day is this?
Uh, I'm just gonna go find a cash machine.
Well, they finally did it. They killed my fucking car.
Walter, he peed on my rug!
Mr. Treehorn treats objects like women, man.
I! The Royal 'we'! You know, the editorial...
Oh, the usual. I bowl. Drive around. The occasional acid flashback.
Fuckin' A.
Hey, careful, man, there's a beverage here!
It's uh... uh... it's down there somewhere, let me take another look.
That's a great plan, Walter. That's fuckin' ingenious, if I understand it correctly. It's a Swiss fuckin' watch.
Mind if I do a J?
This aggression will not stand, man.
Uzi?
At least I'm housebroken.
I hate the fuckin' Eagles man.
Also, my rug was stolen.
I don't see any connection to Vietnam, Walter.
And, you know, he's got emotional problems, man.
Jesus, man, could you change the channel?
Yeah, well, that's just, like, your opinion, man.
She probably kidnapped herself.
You human paraquat!
Nice marmont.
Do you see a wedding ring on my finger? Does this place look like I'm fucking married? The toilet seat's up, man!
You brought a fucking Pomeranian bowling?
I want a fucking lawyer, man. I want Bill Kunstler, or Ron Kuby.
That's fucking interesting, man. That's fucking interesting.
Where's the fucking money, you little brat?
Jesus.";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function the_dude() {
	$chosen = the_dude_get_lyric();
	echo "<p id='dude'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'the_dude' );

// We need some CSS to position the paragraph
function dude_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#dude {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'dude_css' );

// Replace welcome message
function the_dude_welcome($translated_text, $text, $domain) {  
    $new_message = str_replace('Howdy', 'His Dudeness', $text);  
    return $new_message;  
}  
add_filter('gettext', 'the_dude_welcome', 10, 3);
?>