<?php
	echo Form::open('/admin/values')
		.Form::label('value[price_banquet_member]', 'Pris för Kårmedlemmar')
		.Form::input('value[price_banquet_member]', Model::factory('status')->get_value('price_banquet_member'))
		
		.Form::label('value[price_banquet_nonmember]', 'Pris för icke Kårmedlemmar')
		.Form::input('value[price_banquet_nonmember]', Model::factory('status')->get_value('price_banquet_nonmember'))
		
		.Form::label('value[payment_due]', 'När ska betalningen vara inne')
		.Form::input('value[payment_due]', Model::factory('status')->get_value('payment_due'))
		
		.Form::submit(false, 'Uppdatera')
		.Form::close();