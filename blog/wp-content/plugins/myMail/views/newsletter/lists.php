<?php
	$editable = !in_array($post->post_status, array('active', 'finished'));
	if(isset($_GET['showstats']) && $_GET['showstats'] && $post->post_status == 'autoresponder') $editable = false;
	
	$taxonomy = 'newsletter_lists';
	
	$listdata = isset($this->post_data['list']) ? $this->post_data['list'] : array('operator' => 'OR');
	
 if($editable):
	$defaults = array('taxonomy' => 'category');
	if ( !isset($box['args']) || !is_array($box['args']) )
		$args = array();
	else
		$args = $box['args'];
	extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	$tax = get_taxonomy($taxonomy);

	?>
	<ul class="category-tabs">
		<li class="tabs"><?php _e('send campaign to these lists', 'mymail'); ?></li>
	</ul>
	<div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydivs tabs-panel">
		
		<div class="">
		<label><input type="checkbox" id="all_lists"> <?php _e('toggle all', 'mymail'); ?></label>

		<div id="<?php echo $taxonomy; ?>-all">
			<?php
			$name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
			echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
			?>
			<ul>
				<?php wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => false , 'checked_ontop' => false, 'walker' => new mymail_Walker_Category_Checklist )) ?>
			</ul>
		</div>
		</div>
		<label><input type="checkbox" name="mymail_data[list_conditions]" id="list_extra" value="1" <?php checked(isset($listdata['conditions'])) ?>> <?php _e('only if', 'mymail'); ?></label>
		<div id="mymail_list_advanced" <?php if(!isset($listdata['conditions'])) { echo 'style="display:none"';}?>>
			<p>
			<select id="mymail_list_operator" class="widefat" name="mymail_data[list][operator]">
				<option value="OR"<?php selected($listdata['operator'], 'OR')?> title="<?php _e('or', 'mymail'); ?>"><?php _e('one of the conditions is true', 'mymail'); ?></option>
				<option value="AND"<?php selected($listdata['operator'], 'AND')?> title="<?php _e('and', 'mymail'); ?>"><?php _e('all of the conditions are true', 'mymail'); ?></option>
			</select>
			</p>
			<?php 
				
				if(!isset($listdata['conditions'])) $listdata['conditions'] = array(
					array(
						'field' => '',
						'operator' => '',
						'value' => '',
					)
				);
				
				$fields = array(
					'email' => mymail_text('email'),
					'firstname' => mymail_text('firstname'),
					'lastname' => mymail_text('lastname'),
				);
				if ($customfield = mymail_option('custom_field')) {
					foreach ($customfield as $field => $data) {
						$fields[$field] = $data['name'];
					}
				}
				
				$operators = array(
					'is' => __('is', 'mymail'),
					'is_not' => __('is not', 'mymail'),
					'contains' => __('contains', 'mymail'),
					'contains_not' => __('contains not', 'mymail'),
					'begin_with' => __('begins with', 'mymail'),
					'end_with' => __('ends with', 'mymail'),
				);
							
				foreach($listdata['conditions'] as $i => $condition){
					if(!isset($condition['field'])) $condition['field'] = '';
					if(!isset($condition['operator'])) $condition['operator'] = '';
					?>
			<div class="mymail_list_condition" id="mymail_list_condition_<?php echo $i;?>">
				<select name="mymail_data[list][conditions][<?php echo $i;?>][field]">
				<?php foreach( $fields as $value => $name ){
					echo '<option value="'.$value.'"'.selected($condition['field'], $value, false).'>'.$name.'</option>';
				}?>
				</select>
				<select name="mymail_data[list][conditions][<?php echo $i;?>][operator]">
				<?php foreach( $operators as $value => $name ){
					echo '<option value="'.$value.'"'.selected($condition['operator'], $value, false).'>'.$name.'</option>';
				}?>
				</select><br>
				<input type="text" class="widefat" name="mymail_data[list][conditions][<?php echo $i;?>][value]" value="<?php echo esc_attr($condition['value']) ?>">
				<div><a class="remove-condition" title="<?php _e('remove condition', 'mymail'); ?>"><?php _e('remove', 'mymail'); ?></a></div>
			</div>	
					<?php
				}
			?>
			 <a class="add-condition" title="<?php _e('add condition', 'mymail'); ?>"><?php _e('add condition', 'mymail'); ?></a>
	 	</div>
	</div>
		<p class="totals"><?php _e('Total receivers', 'mymail'); ?>: <span id="mymail_total"></span></p>
<?php else :

		?><div><p><?php
		$tax = get_the_taxonomies($post->ID, 'template=%2$l');
		if(isset($tax['newsletter_lists'])) :
		
			echo __('Lists', 'mymail').':<br>'.str_replace(array('<a', '/a>'), array('<strong', '/strong>'), $tax['newsletter_lists']);
		
		else :
		
			_e('no lists selected', 'mymail');
		
		endif;
		?></p><?php
		if(isset($listdata['conditions'])){
			$fields = array(
				'email' => mymail_text('email'),
				'firstname' => mymail_text('firstname'),
				'lastname' => mymail_text('lastname'),
			);
			if ($customfield = mymail_option('custom_field')) {
				foreach ($customfield as $field => $data) {
					$fields[$field] = $data['name'];
				}
			}
			
			echo '<p>'.__('only if', 'mymail').'<br>';
			
			$conditions = array();
			$operators = array(
				'is' => __('is', 'mymail'),
				'is_not' => __('is not', 'mymail'),
				'contains' => __('contains', 'mymail'),
				'contains_not' => __('contains not', 'mymail'),
				'begin_with' => __('begins with', 'mymail'),
				'end_with' => __('ends with', 'mymail'),
			);
			
			foreach($listdata['conditions'] as $condition){
				if(!isset($fields[$condition['field']])){
					echo '<span class="mymail-icon warning"></span> '.sprintf(__('%s is missing!', 'mymail'), '"'.$condition['field'].'"').'<br>';
					continue;
				}
				$conditions[] = '<strong>'.$fields[$condition['field']].'</strong> '.$operators[$condition['operator']].' "<strong>'.$condition['value'].'</strong>"';
			}
			
			echo implode('<br>'.__(strtolower($listdata['operator']), 'mymail').' ', $conditions).'</p>';
				
		}
		?></div><?php

	if($post->post_status != 'autoresponder' && current_user_can('mymail_assign_lists') && current_user_can('mymail_edit_lists')) :
		?>
		
		<a class="create-new-list button" href="#"><?php _e('create new list', 'mymail');?></a>
		<div class="create-new-list-wrap">
		<h4><?php _e('create a new list with all', 'mymail');?></h4>
		<p>
		<select class="create-list-type">
		<?php
		$options = array(
			'all' => __('who have received', 'mymail'),
			'not' => __('who have not received', 'mymail'),
			'open' => __('who have opened', 'mymail'),
			'open_not_click' => __('who have opened but not clicked', 'mymail'),
			'click' => __('who have opened and clicked', 'mymail'),
			'not_open' => __('who have not opened', 'mymail'),
		);
		foreach($options as $id => $option){ ?>
			<option value="<?php echo $id?>"><?php echo $option ?></option>
		<?php } ?>
		
		</select>
		</p>
		<p><a class="create-list button"><?php _e('create list', 'mymail'); ?></a>
		</p>
		<p class="totals"><?php _e('Total receivers', 'mymail'); ?>: <span id="mymail_total">-</span></p>
		</div>
		<?php
	 endif;
 endif;?>
