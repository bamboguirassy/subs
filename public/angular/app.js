angular.module('Subs',['froala'],()=>{})
.controller('ProgrammeNewController',($scope)=>{
    $scope.profils = [];
    $scope.programme = {};
    $scope.initVals = (profils) => {
        $scope.profils = profils;
        $scope.profils.forEach(type=>type.selected=false);
    };
    $scope.selectProfil = (profil) => {
        profil.selected = !profil.selected;
    }
});