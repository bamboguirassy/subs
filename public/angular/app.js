angular.module('Subs', ['froala'], () => { })
    .value('froalaConfig', {
        toolbarInline: false,
        placeholderText: 'Renseigner le texte ici...',
        charCounterCount: true,
        codeMirror: true,
        fontFamilySelection: true,
        fontSizeSelection: true,
        attribution: false
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
    });
