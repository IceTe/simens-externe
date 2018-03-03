<?php

namespace Chirurgie;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Chirurgie\Model\Patient;
use Chirurgie\Model\PatientTable;
use Chirurgie\Model\ServiceTable;
use Chirurgie\Model\TarifConsultation;
use Chirurgie\Model\TarifConsultationTable;
use Chirurgie\Model\Service;
use Chirurgie\Model\Admission;
use Chirurgie\Model\AdmissionTable;


use Chirurgie\Model\Consultation;
use Chirurgie\Model\ConsultationTable;
use Chirurgie\Model\MotifAdmission;
use Chirurgie\Model\RvPatientConsTable;
use Chirurgie\Model\RvPatientCons;
use Chirurgie\Model\MotifAdmissionTable;
use Chirurgie\Model\TransfererPatientServiceTable;
use Chirurgie\Model\TransfererPatientService;
use Chirurgie\Model\DonneesExamensPhysiquesTable;
use Chirurgie\Model\DonneesExamensPhysiques;
use Chirurgie\Model\DiagnosticsTable;
use Chirurgie\Model\Diagnostics;
use Chirurgie\Model\Ordonnance;
use Chirurgie\Model\OrdonnanceTable;
use Chirurgie\Model\DemandeVisitePreanesthesiqueTable;
use Chirurgie\Model\DemandeVisitePreanesthesique;
use Chirurgie\Model\NotesExamensMorphologiquesTable;
use Chirurgie\Model\NotesExamensMorphologiques;
use Chirurgie\Model\DemandeTable;
use Chirurgie\Model\Demande;
use Chirurgie\Model\OrdonConsommable;
use Chirurgie\Model\OrdonConsommableTable;
use Chirurgie\Model\AntecedentPersonnelTable;
use Chirurgie\Model\AntecedentPersonnel;
use Chirurgie\Model\AntecedentsFamiliauxTable;
use Chirurgie\Model\AntecedentsFamiliaux;
use Chirurgie\Model\DemandehospitalisationTable;
use Chirurgie\Model\Demandehospitalisation;
use Chirurgie\Model\Soinhospitalisation;
use Chirurgie\Model\SoinhospitalisationTable;
use Chirurgie\Model\SoinsTable;
use Chirurgie\Model\Soins;
use Chirurgie\Model\HospitalisationTable;
use Chirurgie\Model\Hospitalisation;
use Chirurgie\Model\HospitalisationlitTable;
use Chirurgie\Model\Hospitalisationlit;
use Chirurgie\Model\LitTable;
use Chirurgie\Model\Lit;
use Chirurgie\Model\SalleTable;
use Chirurgie\Model\Salle;
use Chirurgie\Model\BatimentTable;
use Chirurgie\Model\Batiment;
use Chirurgie\Model\ResultatVisitePreanesthesiqueTable;
use Chirurgie\Model\ResultatVisitePreanesthesique;
use Chirurgie\Model\DemandeActeTable;
use Chirurgie\Model\DemandeActe;

use Chirurgie\Model\OrganeTable;
use Chirurgie\Model\ClassePathologieTable;
use Chirurgie\Model\ClassePathologie;
use Chirurgie\Model\ClasseOrganePathologieTable;
use Chirurgie\Model\ClasseOrganePathologie;
use Chirurgie\Model\TypePathologieTable;
use Chirurgie\Model\TypePathologie;
use Chirurgie\Model\ConsultantOrganeTable;
use Chirurgie\Model\ConsultantOrgane;
use Chirurgie\Model\ResultatExamensComplementairesTable;
use Chirurgie\Model\ResultatExamensComplementaires;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface, ViewHelperProviderInterface {

	public function registerJsonStrategy(MvcEvent $e)
	{
		$app          = $e->getTarget();
		$locator      = $app->getServiceManager();
		$view         = $locator->get('Zend\View\View');
		$jsonStrategy = $locator->get('ViewJsonStrategy');

		// Attach strategy, which is a listener aggregate, at high priority
		$view->getEventManager()->attach($jsonStrategy, 100);
	}

	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
						)
				)
		);
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	public function getServiceConfig() {
		return array (
				'factories' => array (
                                    
                         
		
				    
                                    'Chirurgie\Model\TypePathologieTable' => function ($sm) {
				    $tableGateway = $sm->get('typePathologieFactGateway');
				    $table = new TypePathologieTable($tableGateway);
				    return $table;
				    },
				    'TypePathologieTableFactGateway' => function($sm) {
				    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				    $resultSetPrototype = new ResultSet();
				    $resultSetPrototype->setArrayObjectPrototype(new TypePathologieTable());
				    return new TableGateway('type_pathologie', $dbAdapter, null, $resultSetPrototype);
				    },
                                    
                                    
                                    'Chirurgie\Model\ClasseOrganePathologieTable' => function ($sm) {
				    $tableGateway = $sm->get('ClasseOrganePathologieFactGateway');
				    $table = new ClasseOrganePathologieTable($tableGateway);
				    return $table;
				    },
				    'ClasseOrganePathologieTableFactGateway' => function($sm) {
				    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				    $resultSetPrototype = new ResultSet();
				    $resultSetPrototype->setArrayObjectPrototype(new ClasseOrganePathologie());
				    return new TableGateway('classe_organe_pathologie', $dbAdapter, null, $resultSetPrototype);
				    },
                                     'Chirurgie\Model\ConultantOrganeTable' => function ($sm) {
				    $tableGateway = $sm->get('ConsultantOrganeFactGateway');
				    $table = new ConultantOrganeTable($tableGateway);
				    return $table;
				    },
				    'ConsultantOrganeTableFactGateway' => function($sm) {
				    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				    $resultSetPrototype = new ResultSet();
				    $resultSetPrototype->setArrayObjectPrototype(new ConsultantOrgane());
				    return new TableGateway('consultant_organe', $dbAdapter, null, $resultSetPrototype);
				    },
				    'Chirurgie\Model\OrganeTable' => function ($sm) {
				    $tableGateway = $sm->get('OrganeFactGateway');
				    $table = new OrganeTable($tableGateway);
				    return $table;
				    },
				    'OrganeTableFactGateway' => function($sm) {
				    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				    $resultSetPrototype = new ResultSet();
				    $resultSetPrototype->setArrayObjectPrototype(new Organe());
				    return new TableGateway('organe', $dbAdapter, null, $resultSetPrototype);
				    },
				    'Chirurgie\Model\ClassePathologieTable' => function ($sm) {
				    $tableGateway = $sm->get('ClassePathologieFactGateway');
				    $table = new ClassePathologieTable($tableGateway);
				    return $table;
				    },
				    'ClassePathologieTableFactGateway' => function($sm) {
				    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				    $resultSetPrototype = new ResultSet();
				    $resultSetPrototype->setArrayObjectPrototype(new ClassePathologie());
				    return new TableGateway('classe_pathologie', $dbAdapter, null, $resultSetPrototype);
				    },
						'Chirurgie\Model\PatientTable' => function ($sm) {
							$tableGateway = $sm->get ( 'PatientTable1Gateway' );
							$table = new PatientTable ( $tableGateway );
							return $table;
						},
						'PatientTable1Gateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Patient () );
							return new TableGateway ( 'patient', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\ServiceTable' => function ($sm) {
							$tableGateway = $sm->get('ServiceTableFactGateway');
							$table = new ServiceTable($tableGateway);
							return $table;
						},
						'ServiceTableFactGateway' => function($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Service());
							return new TableGateway('service', $dbAdapter, null, $resultSetPrototype);
						},
						'Chirurgie\Model\TarifConsultationTable' => function ($sm) {
							$tableGateway = $sm->get( 'TarifConsultationTableGateway' );
							$table = new TarifConsultationTable( $tableGateway );
							return $table;
						},
						'TarifConsultationTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype (new TarifConsultation());
							return new TableGateway ( 'tarif_consultation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\AdmissionTable' => function ($sm) {
							$tableGateway = $sm->get( 'AdmissionTableGateway' );
							$table = new AdmissionTable( $tableGateway );
							return $table;
						},
						'AdmissionTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Admission() );
							return new TableGateway ( 'admission', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\ConsultationTable' => function ($sm) {
							$tableGateway = $sm->get ( 'ConsultationTableConsGateway' );
							$table = new ConsultationTable ( $tableGateway );
							return $table;
						},
						'ConsultationTableConsGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new Consultation());
							return new TableGateway ( 'consultation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\MotifAdmissionTable' => function ($sm) {
							$tableGateway = $sm->get ( 'MotifAdmissionTableGateway' );
							$table = new MotifAdmissionTable($tableGateway);
							return $table;
						},
						'MotifAdmissionTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new MotifAdmission());
							return new TableGateway ( 'motif_admission', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\RvPatientConsTable' => function ($sm) {
							$tableGateway = $sm->get ( 'RvPatientConsTableGateway' );
							$table = new RvPatientConsTable ( $tableGateway );
							return $table;
						},
						'RvPatientConsTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new RvPatientCons());
							return new TableGateway ( 'rendezvous_consultation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\TransfererPatientServiceTable' => function ($sm) {
							$tableGateway = $sm->get ( 'TransfererPatientServiceTableGateway' );
							$table = new TransfererPatientServiceTable($tableGateway);
							return $table;
						},
						'TransfererPatientServiceTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new TransfererPatientService());
							return new TableGateway ( 'transferer_patient_service', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DonneesExamensPhysiquesTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DonneesExamensPhysiquesTableGateway' );
							$table = new DonneesExamensPhysiquesTable($tableGateway);
							return $table;
						},
						'DonneesExamensPhysiquesTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new DonneesExamensPhysiques());
							return new TableGateway ( 'Donnees_examen_physique', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DiagnosticsTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DiagnosticsTableGateway' );
							$table = new DiagnosticsTable($tableGateway);
							return $table;
						},
						'DiagnosticsTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new Diagnostics());
							return new TableGateway ( 'diagnostic', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\OrdonnanceTable' => function ($sm) {
							$tableGateway = $sm->get ( 'OrdonnanceTableGateway' );
							$table = new OrdonnanceTable($tableGateway);
							return $table;
						},
						'OrdonnanceTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new Ordonnance());
							return new TableGateway ( 'ordonnance', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DemandeVisitePreanesthesiqueTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DemandeVisitePreanesthesiqueTableGateway' );
							$table = new DemandeVisitePreanesthesiqueTable($tableGateway);
							return $table;
						},
						'DemandeVisitePreanesthesiqueTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new DemandeVisitePreanesthesique());
							return new TableGateway ( 'demande_visite_preanesthesique', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\NotesExamensMorphologiquesTable' => function ($sm) {
							$tableGateway = $sm->get ( 'NotesExamensMorphologiquesTableGateway' );
							$table = new NotesExamensMorphologiquesTable($tableGateway);
							return $table;
						},
						'NotesExamensMorphologiquesTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new NotesExamensMorphologiques());
							return new TableGateway ( 'note_examen_morphologique', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DemandeTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DemandeTableGateway' );
							$table = new DemandeTable($tableGateway);
							return $table;
						},
						'DemandeTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new Demande());
							return new TableGateway ( 'demande', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\OrdonConsommableTable' => function ($sm) {
							$tableGateway = $sm->get ( 'OrdonConsommableTableGateway' );
							$table = new OrdonConsommableTable($tableGateway);
							return $table;
						},
						'OrdonConsommableTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new OrdonConsommable());
							return new TableGateway ( 'ordon_consommable', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\AntecedentPersonnelTable' => function ($sm) {
							$tableGateway = $sm->get ( 'AntecedentPersonnelPatientTableGateway' );
							$table = new AntecedentPersonnelTable($tableGateway);
							return $table;
						},
						'AntecedentPersonnelPatientTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new AntecedentPersonnel());
							return new TableGateway ( 'ant_personnels_patient', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\AntecedentsFamiliauxTable' => function ($sm) {
							$tableGateway = $sm->get ( 'AntecedentsFamiliauxPatientTableGateway' );
							$table = new AntecedentsFamiliauxTable($tableGateway);
							return $table;
						},
						'AntecedentsFamiliauxPatientTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new AntecedentsFamiliaux());
							return new TableGateway ( 'ant_familiaux_patient', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DemandehospitalisationTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DemandehospitalisationTableeGateway' );
							$table = new DemandehospitalisationTable ( $tableGateway );
							return $table;
						},
						'DemandehospitalisationTableeGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Demandehospitalisation () );
							return new TableGateway ( 'demande_hospitalisation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\SoinhospitalisationTable' => function ($sm) {
							$tableGateway = $sm->get ( 'SoinhospitalisationConsTableGateway' );
							$table = new SoinhospitalisationTable( $tableGateway );
							return $table;
						},
						'SoinhospitalisationConsTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Soinhospitalisation() );
							return new TableGateway ( 'soins_hospitalisation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\SoinsTable' => function ($sm) {
							$tableGateway = $sm->get ( 'SoinsTableGateway' );
							$table = new SoinsTable( $tableGateway );
							return $table;
						},
						'SoinsTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Soins() );
							return new TableGateway ( 'soins', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\HospitalisationTable' => function ($sm) {
							$tableGateway = $sm->get ( 'HospitalisationTableGateway' );
							$table = new HospitalisationTable ( $tableGateway );
							return $table;
						},
						'HospitalisationTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Hospitalisation() );
							return new TableGateway ( 'hospitalisation', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\HospitalisationlitTable' => function ($sm) {
							$tableGateway = $sm->get ( 'HospitalisationlitTableGateway' );
							$table = new HospitalisationlitTable ( $tableGateway );
							return $table;
						},
						'HospitalisationlitTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Hospitalisationlit() );
							return new TableGateway ( 'hospitalisation_lit', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\LitTable' => function ($sm) {
							$tableGateway = $sm->get ( 'LitTableGateway' );
							$table = new LitTable ( $tableGateway );
							return $table;
						},
						'LitTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Lit() );
							return new TableGateway ( 'lit', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\SalleTable' => function ($sm) {
							$tableGateway = $sm->get ( 'SalleTableGateway' );
							$table = new SalleTable( $tableGateway );
							return $table;
						},
						'SalleTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Salle() );
							return new TableGateway ( 'salle', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\BatimentTable' => function ($sm) {
							$tableGateway = $sm->get ( 'BatimentTableGateway' );
							$table = new BatimentTable ( $tableGateway );
							return $table;
						},
						'BatimentTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new Batiment () );
							return new TableGateway ( 'batiment', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\ResultatVisitePreanesthesiqueTable' => function ($sm) {
							$tableGateway = $sm->get ( 'ResultatVisitePreanesthesiqueTableGateway' );
							$table = new ResultatVisitePreanesthesiqueTable( $tableGateway );
							return $table;
						},
						'ResultatVisitePreanesthesiqueTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet ();
							$resultSetPrototype->setArrayObjectPrototype ( new ResultatVisitePreanesthesique() );
							return new TableGateway ( 'resultat_vpa', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\DemandeActeTable' => function ($sm) {
							$tableGateway = $sm->get ( 'DemandeActeTableGateway' );
							$table = new DemandeActeTable($tableGateway);
							return $table;
						},
						'DemandeActeTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new DemandeActe());
							return new TableGateway ( 'demande_acte', $dbAdapter, null, $resultSetPrototype );
						},
						'Chirurgie\Model\ResultatExamensComplementairesTable' => function ($sm) {
							$tableGateway = $sm->get ( 'ResultatExamensComplementairesTableGateway' );
							$table = new ResultatExamensComplementairesTable($tableGateway);
							return $table;
						},
						'ResultatExamensComplementairesTableGateway' => function ($sm) {
							$dbAdapter = $sm->get ( 'Zend\Db\Adapter\Adapter' );
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype ( new ResultatExamensComplementaires());
							return new TableGateway ( 'resultats_examens', $dbAdapter, null, $resultSetPrototype );
						},
						
					
				)
		);
	}
	public function getViewHelperConfig() {
		return array ();
	}
}