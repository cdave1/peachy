<?php 

DisplayTitle('Latest Commands:'); 

$commands = showLatestCommands(10, "dtCreated");

if (false === $commands) {
	echo "There are no commands.";
} else {
	foreach($commands as $command) {
		echo '<div id="command">';
		echo '<h3>' . $command->strixCommand . '</h3>';
		
		echo '<div id="commandFunctions">';
		echo '<b>Usage: </b><br />';
		echo '<table border="0" cellspacing="0" cellpadding="10">';
		foreach($command->Options as $option) {
			echo '<tr>';
			echo '<td valign="top">';
			if ($option->ixOption == $command->ixfOptionDefault) {
				echo $option->strDescription . "&nbsp;(default):&nbsp;";
			} else {
				echo $option->strDescription . ":&nbsp;";
			}
			echo '</td>';
			echo '<td valign="top">';
			if ($option->ixOption == $command->ixfOptionDefault) {
				echo '<span style="font-family: courier;">' . getDefaultQueryString($command,$option) . "</span>&nbsp;&nbsp;<br />";
			} 
			echo '<span style="font-family: courier;">' . getExecutableQueryString($command, $option) . '</span>&nbsp;&nbsp;';
			echo '<input type="hidden" id="' . $option->strixOption . '" value="' . getExecutableQueryString($command, $option) . '" />(<a href="#" onClick="testCommand(\'' . $option->strixOption . '\')">test</a>)';
			echo '</td>';
			echo '</tr>';
			
		}
		echo '</table>';
		echo '</div>';
		echo '&raquo;<a href="/command/edit/' . $command->strixCommand . '">Edit this command</a>&nbsp;<br /><br />';
		echo '<small>Created by: <a href="/member/' . $command->scnmCreator . '">' . $command->scnmCreator . '</a>&nbsp;|&nbsp;';
		echo 'Last modified on ' . date("H:i, D d of M", $command->dtLastModified) . ' by <a href="/member/' . $command->scnmModifiedBy . '">' . $command->scnmModifiedBy . '</a></small>';
		echo '</div>';
		?>
	
		<?
	}
}

?>
