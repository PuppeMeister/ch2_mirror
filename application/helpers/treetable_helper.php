<?php

if( !function_exists('treetable') )
{
	function treetable( $array_of_perms )
	{

		foreach ($array_of_perms as $perm) {
			
			echo '<tr data-tt-id="'.$perm->link_id.'"'.( $perm->link_parent != NULL ? ' data-tt-parent-id="'.$perm->link_parent.'">' : '>' )."\n" ;
			echo "\t\t\t\t".'<td>'.$perm->label.'</td>'."\n";
			echo "\t\t\t\t".'<td><input  data-id="'.$perm->link_id.'" class="mdl" type="checkbox" '.( ( isset($perm->allowed) ? $perm->allowed : 0 ) == 1 ? "checked" : "" ).' ></td>'."  \n\t\t\t".'</tr>'."\n";

            if( isset( $perm->child ) )
            {
            	treetable($perm->child);
            }	
		}
	}
}