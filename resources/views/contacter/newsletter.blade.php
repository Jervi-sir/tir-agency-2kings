@component('mail::message')

# Merci d'abonner!


Toutes nos félicitations! Vous venez de vous abonner à notre exemple de newsletter.


Si vous voulez désabonner de notre newsletter, cliquer ci-dessous. 

@component('mail::button', ['url' => 'google.com'])
	Se désabonner
@endcomponent

@endcomponent