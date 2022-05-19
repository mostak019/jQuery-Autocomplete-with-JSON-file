<script type="text/javascript">
		$(document).ready(function(){
			let jsonArray=new Array();
			fetch("{{ asset('data/gtw.json') }}",{
						method: 'GET',
						headers: {
							'Content-Type': 'application/json'
						},
						mode: 'cors',
						cache: 'default'
					})
					  .then(function(res){
						  return res.json();
					  })
					  .then(function(json) {
							for (const [key, value] of Object.entries(json)) {
								jsonArray.push(value);
							}
					  });
			$('#search').autocomplete({
			  source: jsonArray,
			  select: function (event, ui) {
						//var hiddenValue = $(this).attr('data-section');
						//$(this).val(ui.item.label); // display the selected text
						$(this).val(''); // display the selected text
						//$('#'+hiddenValue).val(ui.item.value); // save selected id to hidden input
						window.location.href = baseUrl+'/product/'+ui.item.slug;
						return false;
			  },
			  open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			  },
			  close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			  }
			}).autocomplete( "instance" )._renderItem = function( ul, item ) {
			  return $( "<li>" )
				.append( '<div class="ui-item-list-wrapp"><a href="'+baseUrl+'/product/'+item.slug+'"> '+item.label+' </a></div>' )
				.appendTo( ul );
			};
		});
	</script>
