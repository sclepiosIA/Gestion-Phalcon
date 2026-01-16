<?php
use Phalcon\ModelBase;

class EtablissementUsers extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $etus_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $etus_user_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $etus_etablissement_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $etus_nom;

	/**
	 * @Column(column='prenom', type='text', mtype='text', nullable=false)
	 */
	public $etus_prenom;

	/**
	 * @Column(column='email', type='text', mtype='text', nullable=false, key='MUL')
	 */
	public $etus_email;

	/**
	 * @Column(column='telephone', type='text', mtype='text', nullable=true)
	 */
	public $etus_telephone;

	/**
	 * @Column(column='fonction', type='text', mtype='text', nullable=false)
	 */
	public $etus_fonction;

	/**
	 * @Column(column='service', type='text', mtype='text', nullable=true)
	 */
	public $etus_service;

	/**
	 * @Column(column='specialite', type='text', mtype='text', nullable=true)
	 */
	public $etus_specialite;

	/**
	 * @Column(column='statut_formation', type='', mtype='enum', nullable=false, default='non_forme', key='MUL', 'length': 'non_forme,en_cours,forme,a_rafraichir')
	 */
	public $etus_statut_formation;

	/**
	 * @Column(column='date_premiere_formation', type='date', mtype='date', nullable=true)
	 */
	public $etus_date_premiere_formation;

	/**
	 * @Column(column='date_derniere_formation', type='date', mtype='date', nullable=true)
	 */
	public $etus_date_derniere_formation;

	/**
	 * @Column(column='nombre_sessions_suivies', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $etus_nombre_sessions_suivies;

	/**
	 * @Column(column='derniere_utilisation', type='datetime', mtype='datetime', nullable=true)
	 */
	public $etus_derniere_utilisation;

	/**
	 * @Column(column='nombre_connexions', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $etus_nombre_connexions;

	/**
	 * @Column(column='actif', type='integer', mtype='tinyint', nullable=true, default='1', 'length': 1)
	 */
	public $etus_actif;

	/**
	 * @Column(column='compte_verrouille', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $etus_compte_verrouille;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $etus_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $etus_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $etus_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('etus_id', 'EnquetesSatisfactionFormation', 'ensafo_user_id', array('alias' => 'enquetes_satisfaction_formation_user_id'));
		$this->hasMany('etus_id', 'EnquetesSatisfactionSolution', 'ensaso_user_id', array('alias' => 'enquetes_satisfaction_solution_user_id'));
		$this->hasMany('etus_id', 'EtablissementUserRoles', 'etusro_user_id', array('alias' => 'etablissement_user_roles_user_id'));
		$this->hasMany('etus_id', 'FormationEmargements', 'foem_user_id', array('alias' => 'formation_emargements_user_id'));
		$this->hasMany('etus_id', 'ForumComments', 'foco_user_id', array('alias' => 'forum_comments_user_id'));
		$this->hasMany('etus_id', 'ForumPosts', 'fopo_user_id', array('alias' => 'forum_posts_user_id'));
		$this->hasMany('etus_id', 'ForumVotes', 'fovo_user_id', array('alias' => 'forum_votes_user_id'));

		$this->belongsTo('etus_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('etus_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('etus_user_id', 'Users', 'us_id', array('alias' => 'users_user_id'));

        $this->setSource('etablissement_users');
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
            'id' => 'etus_id',
			'user_id' => 'etus_user_id',
			'etablissement_id' => 'etus_etablissement_id',
			'nom' => 'etus_nom',
			'prenom' => 'etus_prenom',
			'email' => 'etus_email',
			'telephone' => 'etus_telephone',
			'fonction' => 'etus_fonction',
			'service' => 'etus_service',
			'specialite' => 'etus_specialite',
			'statut_formation' => 'etus_statut_formation',
			'date_premiere_formation' => 'etus_date_premiere_formation',
			'date_derniere_formation' => 'etus_date_derniere_formation',
			'nombre_sessions_suivies' => 'etus_nombre_sessions_suivies',
			'derniere_utilisation' => 'etus_derniere_utilisation',
			'nombre_connexions' => 'etus_nombre_connexions',
			'actif' => 'etus_actif',
			'compte_verrouille' => 'etus_compte_verrouille',
			'created_at' => 'etus_created_at',
			'updated_at' => 'etus_updated_at',
			'created_by' => 'etus_created_by'
        );
    }

}
