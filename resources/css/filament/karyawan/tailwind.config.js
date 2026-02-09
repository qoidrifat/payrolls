import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Karyawan/**/*.php',
        './resources/views/filament/karyawan/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
