/**
 * jquery.notify.js
 *
 * Copyright (c) 2011 omen Chavannes <jombi.php@gmail.com>
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
 * BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
 * ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
 
(function( $ )
{
	if( typeof $.fn.notifyomen !=='function ')
	{	
		$.fn.notifyomen = function()  
		{  
			this.data = { },
			this.callback = function( fn ) 
			{
				if( typeof ( fn ) == 'object') 
				{
					this.data = fn;
					if( this.data.success == 1){ 	
						this.show();
						this.counter( this.data.count );
					} else{
						this.hide();
					}
				}	
			},
			
			this.init = function(){ 
				$(this).addClass("ui-widget-notification"); 
			},
			
			this.show = function(){ 
				$(this).css("display", "inline"); 
			},
			
			this.hide = function(){ 
				$(this).css("display", "none");  
			};
			
			this.counter = function( count ){
				$("#ui-counter-content").html(" ( "+ ( count ? count : 0 ) +" ) ");
			};	
			
			return this;
		}	
	}
})( jQuery );


