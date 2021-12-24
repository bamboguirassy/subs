angular.module('Subs', [], () => { })
    .controller('ProgrammeNewController', ($scope, Country) => {
        $scope.profils = [];
        $scope.programme = {};
        $scope.selectedCountry;
        $scope.countries = [];
        $scope.country_cca2;
        $scope.initVals = (profils) => {
            $scope.profils = profils;
            $scope.profils.forEach(type => type.selected = false);
        };
        $scope.selectProfil = (profil) => {
            profil.selected = !profil.selected;
        }
        // récuperer les pays
        Country.all().then(response => {
            $scope.countries = response.data;
        }).catch(err => {
            console.log(err);
        })
        $scope.selectCountry = () => {
            $scope.selectedCountry = $scope.countries.find((item) => item.cca2 == $scope.country_cca2);
        }
    }).controller('SouscriptionController', ($scope, Country) => {
        $scope.selected = {};
        $scope.selectedCountry;
        $scope.countries = [];
        $scope.country_cca2;
        $scope.select = (item) => {
            $scope.selected = item;
        };

        $scope.submitMontantEditForm = () => {
            $('#souscriptionMontantEdit').attr('action', '/souscription/' + $scope.selected.id)
            $('#souscriptionMontantEdit').submit();
        };
        // récuperer les pays
        Country.all().then(response => {
            $scope.countries = response.data;
        }).catch(err => {
            console.log(err);
        })
        $scope.selectCountry = () => {
            $scope.selectedCountry = $scope.countries.find((item) => item.cca2 == $scope.country_cca2);
        }
        //  new variables and section for formation mod souscription
        $scope.selectedModules = [];
        $scope.montantModuleSelectionne = 0;
        $scope.selectModule = (module) => {
            if($scope.selectedModules.find((mod=>mod.id==module.id))) {
                $scope.selectedModules = $scope.selectedModules.filter(mod=>mod.id!=module.id)
            } else {
                $scope.selectedModules.push(module);
            }
            $scope.montantModuleSelectionne = $scope.selectedModules.map(mod=>mod.montant)?.reduce((total,montant)=>total+montant,0);
        };
    }).controller('AppelFondController', ($scope) => {
        $scope.selected = {};
        $scope.select = (item) => {
            $scope.selected = item;
            console.log(item);
        };
        $scope.changeEtat = () => {
            $('#appelFondEdit').attr('action', '/admin/appelfond/' + $scope.selected.id)
            $('#appelFondEdit').submit();
        };
    });
