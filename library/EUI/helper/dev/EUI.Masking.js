// ---------------------------------------------------------------------------

/* Modul 			auto layout extends jquery on selector 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 ( function( $ ) {
	$('.date').mask("00-00-0000", { placeholder: "__-__-____"});
	$('.time').mask("00:00", { placeholder: "__:__"  });  
	$('.insured-dob').mask("00-00-0000", { placeholder: "__-__-____"});
	$('.credit-expired-card').mask("00/00", { placeholder: "__/__"});
	
 })( jQuery )
 
 
// =============== END JS ==============================