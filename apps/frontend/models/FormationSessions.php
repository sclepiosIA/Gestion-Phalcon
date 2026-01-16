<?php
use Phalcon\ModelBase;

class FormationSessions extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $fose_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $fose_etablissement_id;

	/**
	 * @Column(column='titre', type='text', mtype='text', nullable=false)
	 */
	public $fose_titre;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $fose_description;

	/**
	 * @Column(column='type_formation', type='', mtype='enum', nullable=false, 'length': 'initiale,perfectionnement,rappel,accompagnement')
	 */
	public $fose_type_formation;

	/**
	 * @Column(column='date_debut', type='datetime', mtype='datetime', nullable=false, key='MUL')
	 */
	public $fose_date_debut;

	/**
	 * @Column(column='date_fin', type='datetime', mtype='datetime', nullable=true)
	 */
	public $fose_date_fin;

	/**
	 * @Column(column='duree_heures', type='decimal', mtype='decimal', nullable=false, 'length': 4)
	 */
	public $fose_duree_heures;

	/**
	 * @Column(column='lieu', type='text', mtype='text', nullable=true)
	 */
	public $fose_lieu;

	/**
	 * @Column(column='modalite', type='', mtype='enum', nullable=true, 'length': 'presentiel,distanciel,hybride')
	 */
	public $fose_modalite;

	/**
	 * @Column(column='formateur_nom', type='text', mtype='text', nullable=true)
	 */
	public $fose_formateur_nom;

	/**
	 * @Column(column='formateur_prenom', type='text', mtype='text', nullable=true)
	 */
	public $fose_formateur_prenom;

	/**
	 * @Column(column='formateur_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'RESTRICT', 'length': 36)
	 */
	public $fose_formateur_id;

	/**
	 * @Column(column='nombre_participants_prevus', type='integer', mtype='int', nullable=true)
	 */
	public $fose_nombre_participants_prevus;

	/**
	 * @Column(column='nombre_participants_reels', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $fose_nombre_participants_reels;

	/**
	 * @Column(column='statut', type='', mtype='enum', nullable=false, default='planifiee', key='MUL', 'length': 'planifiee,en_cours,terminee,annulee,reportee')
	 */
	public $fose_statut;

	/**
	 * @Column(column='qr_code_token', type='text', mtype='text', nullable=true, key='UNI')
	 */
	public $fose_qr_code_token;

	/**
	 * @Column(column='qr_code_expires_at', type='datetime', mtype='datetime', nullable=true)
	 */
	public $fose_qr_code_expires_at;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $fose_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $fose_updated_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'RESTRICT', 'length': 36)
	 */
	public $fose_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('fose_id', 'EnquetesSatisfactionFormation', 'ensafo_session_id', array('alias' => 'enquetes_satisfaction_formation_session_id'));
		$this->hasMany('fose_id', 'FormationEmargements', 'foem_session_id', array('alias' => 'formation_emargements_session_id'));

		$this->belongsTo('fose_created_by', 'Profiles', 'pr_id', array('alias' => 'profiles_created_by'));
		$this->belongsTo('fose_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('fose_formateur_id', 'Profiles', 'pr_id', array('alias' => 'profiles_formateur_id'));

        $this->setSource('formation_sessions');
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
            'id' => 'fose_id',
			'etablissement_id' => 'fose_etablissement_id',
			'titre' => 'fose_titre',
			'description' => 'fose_description',
			'type_formation' => 'fose_type_formation',
			'date_debut' => 'fose_date_debut',
			'date_fin' => 'fose_date_fin',
			'duree_heures' => 'fose_duree_heures',
			'lieu' => 'fose_lieu',
			'modalite' => 'fose_modalite',
			'formateur_nom' => 'fose_formateur_nom',
			'formateur_prenom' => 'fose_formateur_prenom',
			'formateur_id' => 'fose_formateur_id',
			'nombre_participants_prevus' => 'fose_nombre_participants_prevus',
			'nombre_participants_reels' => 'fose_nombre_participants_reels',
			'statut' => 'fose_statut',
			'qr_code_token' => 'fose_qr_code_token',
			'qr_code_expires_at' => 'fose_qr_code_expires_at',
			'created_at' => 'fose_created_at',
			'updated_at' => 'fose_updated_at',
			'created_by' => 'fose_created_by'
        );
    }

}
