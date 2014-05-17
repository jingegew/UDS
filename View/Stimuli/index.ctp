<?php     
echo $this->Html->script('jquery-ui-1.10.1.custom');
echo $this->Html->script('TableTools.min');
echo $this->Html->script('ZeroClipboard'); 
echo $this->Html->css('TableTools');
echo $this->Html->css('jquery-ui-1.10.1.custom');
echo $this->Html->css('bootstrap_pagination');
?>

<script>

$.extend( $.fn.dataTableExt.oStdClasses, {
    "sSortAsc": "header headerSortDown",
    "sSortDesc": "header headerSortUp",
    "sSortable": "header"
} );

/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
    return {
        "iStart":         oSettings._iDisplayStart,
        "iEnd":           oSettings.fnDisplayEnd(),
        "iLength":        oSettings._iDisplayLength,
        "iTotal":         oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage":          oSettings._iDisplayLength === -1 ?
            0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
        "iTotalPages":    oSettings._iDisplayLength === -1 ?
            0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
    };
}
 
/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
    "bootstrap": {
        "fnInit": function( oSettings, nPaging, fnDraw ) {
            var oLang = oSettings.oLanguage.oPaginate;
            var fnClickHandler = function ( e ) {
                e.preventDefault();
                if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
                    fnDraw( oSettings );
                }
            };
 
            $(nPaging).addClass('pagination').append(
                '<ul>'+
                    '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
                    '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
                '</ul>'
            );
            var els = $('a', nPaging);
            $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
            $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
        },
 
        "fnUpdate": function ( oSettings, fnDraw ) {
            var iListLength = 5;
            var oPaging = oSettings.oInstance.fnPagingInfo();
            var an = oSettings.aanFeatures.p;
            var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);
 
            if ( oPaging.iTotalPages < iListLength) {
                iStart = 1;
                iEnd = oPaging.iTotalPages;
            }
            else if ( oPaging.iPage <= iHalf ) {
                iStart = 1;
                iEnd = iListLength;
            } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
                iStart = oPaging.iTotalPages - iListLength + 1;
                iEnd = oPaging.iTotalPages;
            } else {
                iStart = oPaging.iPage - iHalf + 1;
                iEnd = iStart + iListLength - 1;
            }
 
            for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
                // Remove the middle elements
                $('li:gt(0)', an[i]).filter(':not(:last)').remove();
 
                // Add the new list items and their event handlers
                for ( j=iStart ; j<=iEnd ; j++ ) {
                    sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
                    $('<li '+sClass+'><a href="#">'+j+'</a></li>')
                        .insertBefore( $('li:last', an[i])[0] )
                        .bind('click', function (e) {
                            e.preventDefault();
                            oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
                            fnDraw( oSettings );
                        } );
                }
 
                // Add / remove disabled classes from the static elements
                if ( oPaging.iPage === 0 ) {
                    $('li:first', an[i]).addClass('disabled');
                } else {
                    $('li:first', an[i]).removeClass('disabled');
                }
 
                if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
                    $('li:last', an[i]).addClass('disabled');
                } else {
                    $('li:last', an[i]).removeClass('disabled');
                }
            }
        }
    }
} );

    $(document).ready(function(){
    
	  	$('.datatable').dataTable({
			"sDom": "T<'row-fluid'<'span3'l><'span5'f>r>t<'row-fluid'<'span3'i><'span9'p>>",
			"sPaginationType": "bootstrap",
			 "oTableTools": {
            	"sSwfPath": "/uds/media/swf/copy_csv_xls_pdf.swf"
        	},       	        	
			"oLanguage": {
				"sLengthMenu": "_MENU_ records per page"
			}
		});		
	});  
	
  </script>

<?php 
$experiment = $this->Session->read('Experiment.name');
if(!isset($experiment)):?>
<div class="row-fluid">
<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><?php echo __('No Experiment Selected!');?></h4>
  <?php echo __('Please select an experiment which you would like working on by clicking Experiments menu on the left.');?>
</div>
</div>
<?php else: ?>

<h4><?php echo __('Stimuli'); ?></h4>

<table class="table table-striped bootstrap-datatable datatable dataTable">
	<thead> 
	<tr>
			<th>ID</th>
			<th><span class="popover-test" data-content="<?php echo $header['Stimulus']['description']; ?>" data-original-title="Stimulus Name"><?php echo isset($header['Stimulus']['name'])? $header['Stimulus']['name'] : __('Stimulus'); ?></span></th>
			<?php 
				foreach ($attributes as $attribute) {
					echo '<th><span class="popover-test" data-content="' . $attribute['description'] . '" data-original-title="Stimulus">' . $attribute['name'] . '</span></th>';
				}
			 ?>
	</tr>
		</thead> 
	<tbody> 
	<?php
	foreach ($stimuli as $stimulus): ?>
	<tr>
		<td><?php echo $stimulus['Stimulus']['id']; ?>&nbsp;</td>
		<td><?php echo $stimulus['Stimulus']['name']; ?>&nbsp;</td>
		
		<?php 
			foreach ($attributes as $attribute) {
				if(isset($stimulus['Stimulus'][$attribute['name']])){
					echo "<td>" . $stimulus['Stimulus'][$attribute['name']] . "</td>";
				} else {
					echo "<td></td>";
				}				
			}
		?>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>