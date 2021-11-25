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
    .controller('ProgrammeNewController', ($scope) => {
        $scope.profils = [];
        $scope.programme = {};
        $scope.initVals = (profils) => {
            $scope.profils = profils;
            $scope.profils.forEach(type => type.selected = false);
        };
        $scope.selectProfil = (profil) => {
            profil.selected = !profil.selected;
        }
    }).controller('SouscriptionController', ($scope) => {
        $scope.selected = {};
        $scope.select = (item) => {
            $scope.selected = item;
        };

        $scope.submitMontantEditForm = () => {
            $('#souscriptionMontantEdit').attr('action','/souscription/'+$scope.selected.id)
            $('#souscriptionMontantEdit').submit();
        };
    });
