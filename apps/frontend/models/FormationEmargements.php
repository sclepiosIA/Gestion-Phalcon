<?php
use Phalcon\ModelBase;

class FormationEmargements extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $foem_id;

	/**
	 * @Column(column='session_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $foem_session_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $foem_user_id;

	/**
	 * @Column(column='date_emargement', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $foem_date_emargement;

	/**
	 * @Column(column='present', type='integer', mtype='tinyint', nullable=false, default='1', 'length': 1)
	 */
	public $foem_present;

	/**
	 * @Column(column='retard_minutes', type='integer', mtype='int', nullable=true)
	 */
	public $foem_retard_minutes;

	/**
	 * @Column(column='depart_anticipe', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $foem_depart_anticipe;

	/**
	 * @Column(column='signature_type', type='', mtype='enum', nullable=false, 'length': 'canvas,qr_code,manuel')
	 */
	public $foem_signature_type;

	/**
	 * @Column(column='signature_data', type='text', mtype='text', nullable=true)
	 */
	public $foem_signature_data;

	/**
	 * @Column(column='signature_storage_path', type='text', mtype='text', nullable=true)
	 */
	public $foem_signature_storage_path;

	/**
	 * @Column(column='valide_par', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $foem_valide_par;

	/**
	 * @Column(column='valide_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $foem_valide_at;

	/**
	 * @Column(column='commentaire', type='text', mtype='text', nullable=true)
	 */
	public $foem_commentaire;

	/**
	 * @Column(column='ip_address', type='string', mtype='varchar', nullable=true, 'length': 45)
	 */
	public $foem_ip_address;

	/**
	 * @Column(column='user_agent', type='text', mtype='text', nullable=true)
	 */
	public $foem_user_agent;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $foem_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('foem_session_id', 'FormationSessions', 'fose_id', array('alias' => 'formation_sessions_session_id'));
		$this->belongsTo('foem_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));
		$this->belongsTo('foem_valide_par', 'Profiles', 'pr_id', array('alias' => 'profiles_valide_par'));

        $this->setSource('formation_emargements');
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
            'id' => 'foem_id',
			'session_id' => 'foem_session_id',
			'user_id' => 'foem_user_id',
			'date_emargement' => 'foem_date_emargement',
			'present' => 'foem_present',
			'retard_minutes' => 'foem_retard_minutes',
			'depart_anticipe' => 'foem_depart_anticipe',
			'signature_type' => 'foem_signature_type',
			'signature_data' => 'foem_signature_data',
			'signature_storage_path' => 'foem_signature_storage_path',
			'valide_par' => 'foem_valide_par',
			'valide_at' => 'foem_valide_at',
			'commentaire' => 'foem_commentaire',
			'ip_address' => 'foem_ip_address',
			'user_agent' => 'foem_user_agent',
			'created_at' => 'foem_created_at'
        );
    }

}
