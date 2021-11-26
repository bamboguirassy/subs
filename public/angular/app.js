angular.module('Subs', [], () => {
    $(() => {
        var editor = new Simditor({
            textarea: $('#wysiwyg')
            //optional options
        });
        var editor2 = new Simditor({
            textarea: $('#editor')
            //optional options
        });
    });
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
    }).controller('SouscriptionController', ($scope) => {
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
    });
