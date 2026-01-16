<?php
use Phalcon\ModelBase;

class ProfilesSecrets extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='PRI', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $prse_user_id;

	/**
	 * @Column(column='two_factor_secret', type='text', mtype='text', nullable=true)
	 */
	public $prse_two_factor_secret;

	/**
	 * @Column(column='temp_2fa_secret', type='text', mtype='text', nullable=true)
	 */
	public $prse_temp_2fa_secret;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $prse_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('prse_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('profiles_secrets');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'user_id' => 'prse_user_id',
			'two_factor_secret' => 'prse_two_factor_secret',
			'temp_2fa_secret' => 'prse_temp_2fa_secret',
			'updated_at' => 'prse_updated_at'
        );
    }

}
