<field><?php if (isset($ShowLabel) && $ShowLabel == 'on') { ?><ShowLabel position="<?php if (isset($LabelPosition) && !empty($LabelPosition)) { $position = explode('-', $LabelPosition); $position = $position[0]; echo $position; } else {echo 'left';} ?>"><![CDATA[<label for='ufo-field-id-<?php echo $id;?>' <?php if (isset($LabelCSSClass) && !empty($LabelCSSClass)) {echo "class='$LabelCSSClass'";}; if (isset($LabelPosition)) { $style = array(); $align = explode('-',$LabelPosition); $align = $align[count($align)-1]; $style[] = "text-align:$align"; }; if (isset($LabelCSSStyle) && !empty($LabelCSSStyle)) { $style = array(); $style[] = $LabelCSSStyle; }; if (count($style) > 0) {echo " style='". implode(';',$style). "'";}; ?>><?php echo $Label;if(isset($Required) && $Required == 'on' && isset($SetRequiredSuffix) && $SetRequiredSuffix == 'on' && isset($RequiredSuffix) && !empty($RequiredSuffix)) {?><span <?php if (isset($RequiredSuffixCSSClass) && !empty($RequiredSuffixCSSClass)) {echo "class='$RequiredSuffixCSSClass'";}; if (isset($RequiredSuffixCSSStyle) && !empty($RequiredSuffixCSSStyle)) {echo " style='$RequiredSuffixCSSStyle'";}; ?>><?php echo $RequiredSuffix; ?></span><?php }?></label>]]></ShowLabel><?php } ?><?php if (isset($ShowDescription) && $ShowDescription == 'on') { ?><ShowDescription position="<?php if (isset($DescriptionPosition) && !empty($DescriptionPosition)) { echo $DescriptionPosition; } else {echo 'bottom';} ?>"><![CDATA[<div <?php if (isset($DescriptionCSSClass) && !empty($DescriptionCSSClass)) {echo "class='$DescriptionCSSClass'";}; if (isset($DescriptionCSSStyle) && !empty($DescriptionCSSStyle)) {echo " style='$DescriptionCSSStyle'";}; ?>><?php if (isset($Description)) {echo $Description; }; ?></div>]]></ShowDescription><?php } ?><?php if ((isset($Required) && $Required == 'on') && isset($RequiredMessage) && !empty($RequiredMessage)) { ?><RequiredMessage position="<?php if (isset($RequiredMessagePosition) && !empty($RequiredMessagePosition)) { echo $RequiredMessagePosition; } else {echo 'right';} ?>"><![CDATA[<div id='ufo-field-id-<?php echo $id;?>-invalid' <?php if (isset($RequiredMessageCSSClass) && !empty($RequiredMessageCSSClass)) {echo "class='$RequiredMessageCSSClass'";};?> style='<?php if (isset($RequiredMessageCSSStyle) && !empty($RequiredMessageCSSStyle)) {echo trim($RequiredMessageCSSStyle, ' ;') . ';';};?>display:none'></div>]]></RequiredMessage><?php } ?><?php if ((isset($Required) && $Required == 'on')) { ?><Validation><![CDATA[<?php $config = (object) array(); $config->events = (object) array(); $config->Required = TRUE; $config->events->blur[] = 'required'; if (isset($InvalidCSSClass) && !empty($InvalidCSSClass)) { $config->InvalidCSSClass = $InvalidCSSClass; } if (isset($RequiredMessage) && !empty($RequiredMessage)) { $config->RequiredMessage = htmlspecialchars(str_replace('&#39;', '\'', $RequiredMessage)); } if (isset($AbsolutePosition) && $AbsolutePosition == 'on') { $config->AbsolutePosition = TRUE; } if (isset($RequiredMessagePosition) && !empty($RequiredMessagePosition)) { $config->RequiredMessagePosition = $RequiredMessagePosition; } if (isset($RequiredMessageCSSClass) && !empty($RequiredMessageCSSClass)) { $config->RequiredMessageCSSClass = $RequiredMessageCSSClass; } if (isset($RequiredMessageCSSStyle) && !empty($RequiredMessageCSSStyle)) { $config->RequiredMessageCSSStyle = $RequiredMessageCSSStyle; } $config->events->change[] = 'required'; if (count( (array) $config->events) > 0) { $config->id = "ufo-field-id-$id"; $config->form = "ufo-form-id-$formid"; $js = 'ufoFormsConfig.validations.push(' . json_encode($config) . ');'; echo "<script type='text/javascript'>" . $js . "</script>"; } ?>]]></Validation><?php } ?><Input <?php if (isset($SetSize) && $SetSize == 'on' && isset($Width) && !empty($Width) && isset($WidthUnit) && $WidthUnit != 'chars') {echo ' width="' . $Width . $WidthUnit . '"';}; ?><?php if (isset($RowCSSClass) && !empty($RowCSSClass) && isset($SetStyle) && $SetStyle == 'on') {echo ' rowclass="' . $RowCSSClass . '"';}; ?><?php if (isset($InputPosition) && !empty($InputPosition)) {echo ' position="' . $InputPosition . '"';}; ?>><![CDATA[<select id='ufo-field-id-<?php echo $id;?>' name='id-<?php echo $id;?>' <?php $class = array();if (isset($CSSClass) && !empty($CSSClass)) { $class[] = $CSSClass; };if (count($class) > 0) {echo " class='" . implode(' ', $class) . "'";};if (isset($SetSize) && $SetSize == 'on' && isset($Width) && !empty($Width) && isset($WidthUnit) && $WidthUnit == 'chars') {echo "size='$Width'";};$style = array();if (isset($SetSize) && $SetSize == 'on' && isset($Width) && !empty($Width) && isset($WidthUnit) && !empty($WidthUnit) && $WidthUnit != 'chars') {$style[] = "width:{$Width}{$WidthUnit}";};if (isset($SetStyle) && $SetStyle == 'on' && isset($CSSStyle) && !empty($CSSStyle)) { $style[] = $CSSStyle; };if (count($style) > 0) {echo " style='" . implode(';', $style) . "'";};?>><?php if (isset($HasEmpty) && $HasEmpty == 'on' ) {$eo = isset($EmptyOption) && !empty($EmptyOption) ? $EmptyOption : '...';echo '<option value="">' . $eo . '</option>';}; ?><?php echo EasyContactFormsCustomFormFields::getSelectOptions($id, 'select'); ?></select>]]></Input></field>