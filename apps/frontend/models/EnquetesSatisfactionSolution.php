<?php
use Phalcon\ModelBase;

class EnquetesSatisfactionSolution extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $ensaso_id;

	/**
	 * @Column(column='user_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ensaso_user_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $ensaso_etablissement_id;

	/**
	 * @Column(column='date_reponse', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ensaso_date_reponse;

	/**
	 * @Column(column='satisfaction_solution', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_satisfaction_solution;

	/**
	 * @Column(column='satisfaction_csm', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_satisfaction_csm;

	/**
	 * @Column(column='facilite_utilisation', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_facilite_utilisation;

	/**
	 * @Column(column='intuitivite_interface', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_intuitivite_interface;

	/**
	 * @Column(column='rapidite_execution', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_rapidite_execution;

	/**
	 * @Column(column='temps_gagne', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_temps_gagne;

	/**
	 * @Column(column='confort_usage', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_confort_usage;

	/**
	 * @Column(column='reduction_stress', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_reduction_stress;

	/**
	 * @Column(column='utilite_smr', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_utilite_smr;

	/**
	 * @Column(column='utilite_urgences', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_utilite_urgences;

	/**
	 * @Column(column='utilite_pmsi', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_utilite_pmsi;

	/**
	 * @Column(column='utilite_completion', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_utilite_completion;

	/**
	 * @Column(column='utilite_dictee_vocale', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_utilite_dictee_vocale;

	/**
	 * @Column(column='recommandation_collegues', type='integer', mtype='int', nullable=true)
	 */
	public $ensaso_recommandation_collegues;

	/**
	 * @Column(column='ressenti_roi', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_ressenti_roi;

	/**
	 * @Column(column='fonctionnalites_preferees', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_fonctionnalites_preferees;

	/**
	 * @Column(column='fonctionnalites_manquantes', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_fonctionnalites_manquantes;

	/**
	 * @Column(column='irritants', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_irritants;

	/**
	 * @Column(column='suggestions', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_suggestions;

	/**
	 * @Column(column='commentaire_libre', type='text', mtype='text', nullable=true)
	 */
	public $ensaso_commentaire_libre;

	/**
	 * @Column(column='token_enquete', type='text', mtype='text', nullable=true, key='UNI')
	 */
	public $ensaso_token_enquete;

	/**
	 * @Column(column='repondu_via', type='', mtype='enum', nullable=true, 'length': 'authentifie,lien_public,qr_code,email')
	 */
	public $ensaso_repondu_via;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $ensaso_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('ensaso_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('ensaso_user_id', 'EtablissementUsers', 'etus_id', array('alias' => 'etablissement_users_user_id'));

        $this->setSource('enquetes_satisfaction_solution');
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
            'id' => 'ensaso_id',
			'user_id' => 'ensaso_user_id',
			'etablissement_id' => 'ensaso_etablissement_id',
			'date_reponse' => 'ensaso_date_reponse',
			'satisfaction_solution' => 'ensaso_satisfaction_solution',
			'satisfaction_csm' => 'ensaso_satisfaction_csm',
			'facilite_utilisation' => 'ensaso_facilite_utilisation',
			'intuitivite_interface' => 'ensaso_intuitivite_interface',
			'rapidite_execution' => 'ensaso_rapidite_execution',
			'temps_gagne' => 'ensaso_temps_gagne',
			'confort_usage' => 'ensaso_confort_usage',
			'reduction_stress' => 'ensaso_reduction_stress',
			'utilite_smr' => 'ensaso_utilite_smr',
			'utilite_urgences' => 'ensaso_utilite_urgences',
			'utilite_pmsi' => 'ensaso_utilite_pmsi',
			'utilite_completion' => 'ensaso_utilite_completion',
			'utilite_dictee_vocale' => 'ensaso_utilite_dictee_vocale',
			'recommandation_collegues' => 'ensaso_recommandation_collegues',
			'ressenti_roi' => 'ensaso_ressenti_roi',
			'fonctionnalites_preferees' => 'ensaso_fonctionnalites_preferees',
			'fonctionnalites_manquantes' => 'ensaso_fonctionnalites_manquantes',
			'irritants' => 'ensaso_irritants',
			'suggestions' => 'ensaso_suggestions',
			'commentaire_libre' => 'ensaso_commentaire_libre',
			'token_enquete' => 'ensaso_token_enquete',
			'repondu_via' => 'ensaso_repondu_via',
			'created_at' => 'ensaso_created_at'
        );
    }

}
