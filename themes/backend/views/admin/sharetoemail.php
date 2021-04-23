<meta charset="utf-8">


	<style>
        body{
            font-family: "Trebuchet MS",Tahoma,Verdana,Arial,Helvetica,sans-serif;
            font-size: 0.8em;
        }
        
        .radius{
            border-radius: 4px;
        }
        
        .row{
            padding: 5px 0;
        }
        
        .row label{
            display: block;
        }
        
        h1.title{
            border-bottom: 1px solid #D7D7D7;
            padding: 0 0 5px 0;
            font-weight: normal;
        }
        
        h1.title span{
            color: transparent;
            padding: 0 10px;
            background:url(<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/img/6b49c8b444c8f935c373a9fa4fb242b4.png) no-repeat right;
            background-position: -60px -90px;
        }
        
        input#SendButton{
            background: #fdd446; /* Old browsers */
            /* IE9 SVG, needs conditional override of 'filter' to 'none' */
            background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2ZkZDQ0NiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjU1JSIgc3RvcC1jb2xvcj0iI2ZkZDQ0NiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjczJSIgc3RvcC1jb2xvcj0iI2ZkOTUxMiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZDk1MTIiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
            background: -moz-linear-gradient(top,  #fdd446 0%, #fdd446 55%, #fd9512 73%, #fd9512 100%); /* FF3.6+ */
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fdd446), color-stop(55%,#fdd446), color-stop(73%,#fd9512), color-stop(100%,#fd9512)); /* Chrome,Safari4+ */
            background: -webkit-linear-gradient(top,  #fdd446 0%,#fdd446 55%,#fd9512 73%,#fd9512 100%); /* Chrome10+,Safari5.1+ */
            background: -o-linear-gradient(top,  #fdd446 0%,#fdd446 55%,#fd9512 73%,#fd9512 100%); /* Opera 11.10+ */
            background: -ms-linear-gradient(top,  #fdd446 0%,#fdd446 55%,#fd9512 73%,#fd9512 100%); /* IE10+ */
            background: linear-gradient(top,  #fdd446 0%,#fdd446 55%,#fd9512 73%,#fd9512 100%); /* W3C */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fdd446', endColorstr='#fd9512',GradientType=0 ); /* IE6-8 */
            border: 1px solid #EC8B11;
            border-radius: 4px;
            color:#333333;
            font-weight: bold;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
            width: 100px;
        }
        
        input{
            width: 90%;
            padding: 5px;
        }
        
    </style>
	
	<link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/themes/backend/js/jquery-ui-1.8.21.custom.min.js"></script>	
	<script>
	$(function() {
		var availableTags = [
			<?php
				$i = 0;
				foreach($member as $b):
				$i++;
				
				echo '"'.$b->email.'",';
				
				endforeach;
			?>
		];
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#tags" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	});
	</script>



	<h1 class="title">Share <?php echo $content->contentType->name; ?> <span>.</span></h1>
    
     <?php
		foreach(Yii::app()->user->getFlashes() as $key => $message) {
				echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
		}
	?>
    
    <div class="form">
    
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'share-form',
			'action'=> Yii::app()->request->baseUrl.'/admin/sendarticletoemail',
            'enableAjaxValidation'=>false,
        )); ?>
        
        
            <div class="row">
                <label for="tags">To</label>							
                <input type="text" maxlength="255" id="tags" name="Share[to]">						
            </div>
            
            <div class="row">
                <label>Subject</label>							
                <input type="text" value="<?php echo $content->title; ?> - POIN" maxlength="255" id="Share_subject" name="Share[subject]">						
            </div>
            
            <div class="row" style="display:none;">
                <label for="Content_intro">Intro</label>                                                                
                <textarea id="Share_body" name="Share[body]" cols="70" rows="10" style="visibility: hidden; display: none;">
                	<?php echo $content->body; ?>
                </textarea>
            </div>
        
        	<div class="row buttons">
				<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <input id="SendButton" class="button" type="submit" value="Send" name="send_button">
            </div>
        
        <?php $this->endWidget(); ?>
    
    </div><!-- form -->
    