angular.module('Subs', ['mgcrea.pullToRefresh'], () => { })
    .controller('MainController', ($scope, $q) => {
        $scope.onReload = function() {
            console.warn('reload');
            var deferred = $q.defer();
            setTimeout(function() {
              deferred.resolve(true);
            }, 1000);
            return deferred.promise;
          };
    })
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
