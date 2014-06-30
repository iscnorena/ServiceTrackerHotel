<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	/* metodo para presentar una pagina que no exista
	 y asi evitar que escribar url falsas*/
	public function notFoundUnless($value)
    {
        if ( ! $value) App::abort(404);
    }

}
 