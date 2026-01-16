<?
use Phalcon\ModelBase;

class EnquetesSatisfactionFormation extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $ensafo_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ensafo_user_id;

	/**
	 * @Column(column='session_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $ensafo_session_id;

	/**
	 * @Column(column='date_reponse', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ensafo_date_reponse;

	/**
	 * @Column(column='nps_score', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_nps_score;

	/**
	 * @Column(column='csat_score', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_csat_score;

	/**
	 * @Column(column='clarte_pedagogique', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_clarte_pedagogique;

	/**
	 * @Column(column='qualite_supports', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_qualite_supports;

	/**
	 * @Column(column='competence_formateur', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_competence_formateur;

	/**
	 * @Column(column='utilite_percue', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_utilite_percue;

	/**
	 * @Column(column='adaptation_metier', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_adaptation_metier;

	/**
	 * @Column(column='duree_appropriee', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_duree_appropriee;

	/**
	 * @Column(column='rythme_adapte', type='integer', mtype='int', nullable=true)
	 */
	public $ensafo_rythme_adapte;

	/**
	 * @Column(column='points_forts', type='text', mtype='text', nullable=true)
	 */
	public $ensafo_points_forts;

	/**
	 * @Column(column='points_amelioration', type='text', mtype='text', nullable=true)
	 */
	public $ensafo_points_amelioration;

	/**
	 * @Column(column='suggestions', type='text', mtype='text', nullable=true)
	 */
	public $ensafo_suggestions;

	/**
	 * @Column(column='commentaire_libre', type='text', mtype='text', nullable=true)
	 */
	public $ensafo_commentaire_libre;

	/**
	 * @Column(column='token_enquete', type='text', mtype='text', nullable=true, key='UNI')
	 */
	public $ensafo_token_enquete;

	/**
	 * @Column(column='repondu_via', type='', mtype='enum', nullable=true, 'length': 'authentifie,lien_public,qr_code')
	 */
	public $ensafo_repondu_via;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ensafo_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('ensafo_session_id', 'FormationSessions', 'fose_id', array('alias' => 'formation_sessions_session_id'));
		$this->belongsTo('ensafo_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('enquetes_satisfaction_formation');
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
            'id' => 'ensafo_id',
			'user_id' => 'ensafo_user_id',
			'session_id' => 'ensafo_session_id',
			'date_reponse' => 'ensafo_date_reponse',
			'nps_score' => 'ensafo_nps_score',
			'csat_score' => 'ensafo_csat_score',
			'clarte_pedagogique' => 'ensafo_clarte_pedagogique',
			'qualite_supports' => 'ensafo_qualite_supports',
			'competence_formateur' => 'ensafo_competence_formateur',
			'utilite_percue' => 'ensafo_utilite_percue',
			'adaptation_metier' => 'ensafo_adaptation_metier',
			'duree_appropriee' => 'ensafo_duree_appropriee',
			'rythme_adapte' => 'ensafo_rythme_adapte',
			'points_forts' => 'ensafo_points_forts',
			'points_amelioration' => 'ensafo_points_amelioration',
			'suggestions' => 'ensafo_suggestions',
			'commentaire_libre' => 'ensafo_commentaire_libre',
			'token_enquete' => 'ensafo_token_enquete',
			'repondu_via' => 'ensafo_repondu_via',
			'created_at' => 'ensafo_created_at'
        );
    }

}
