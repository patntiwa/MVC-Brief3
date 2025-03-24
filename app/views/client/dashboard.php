<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord client</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gray-100">

  <!-- Wrapper -->
  <div class="flex h-full">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-gray-100 flex flex-col">
      <div class="px-4 py-6">
        <h1 class="text-2xl font-bold">Mon Dashboard</h1>
      </div>

      <nav class="flex-1">
        <ul>
          <li class="mb-4">
            <a href="?route=clientDashboard" class="block px-4 py-2 hover:bg-gray-700 rounded">
              <i class="fas fa-home"></i> Tableau de bord
            </a>
          </li>
          <li class="mb-4">
            <a href="#services" class="block px-4 py-2 hover:bg-gray-700 rounded">
              <i class="fas fa-star"></i> Mes services
            </a>
          </li>
          <li class="mb-4">
            <a href="#support" class="block px-4 py-2 hover:bg-gray-700 rounded">
              <i class="fas fa-toolbox"></i> Support
            </a>
          </li>
        </ul>
      </nav>

      <div class="px-4 py-6">
        <button onclick="location.href='?route=logout'" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded">
          Déconnexion
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
      <!-- Header -->
      <header class="bg-white shadow">
        <div class="mx-auto px-4 py-4 flex justify-between items-center">
          <h2 class="text-lg font-bold">Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
          <a href="?route=logout" class="text-red-500 hover:text-red-600 text-sm">
            Déconnexion
          </a>
        </div>
      </header>

      <!-- Content Area -->
      <div class="p-6">
        <h3 class="text-2xl font-semibold mb-4">Tableau de bord</h3>
        <p class="text-gray-600">
          Voici votre espace client, où vous pouvez consulter vos services, accéder au support et bien plus encore.
        </p>
        <!-- Contenu supplémentaire -->
        <div class="mt-6">
          <!-- Exemple de tableau avec services -->
          <div class="bg-white shadow rounded-lg p-4">
            <h4 class="font-semibold text-lg mb-4">Vos services récents</h4>
            <table class="min-w-full border-collapse block md:table">
              <thead class="block md:table-header-group">
                <tr class="border border-gray-300 md:border-none block md:table-row">
                  <th class="p-2 text-left block md:table-cell">Service</th>
                  <th class="p-2 text-left block md:table-cell">Statut</th>
                  <th class="p-2 text-left block md:table-cell">Date</th>
                  <th class="p-2 text-left block md:table-cell">Action</th>
                </tr>
              </thead>
              <tbody class="block md:table-row-group">
                <tr class="bg-gray-100 border border-gray-300 md:border-none block md:table-row">
                  <td class="p-2 block md:table-cell">Service 1</td>
                  <td class="p-2 block md:table-cell">Actif</td>
                  <td class="p-2 block md:table-cell">01/10/2023</td>
                  <td class="p-2 block md:table-cell">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                      Voir
                    </button>
                  </td>
                </tr>
                <tr class="bg-gray-50 border border-gray-300 md:border-none block md:table-row">
                  <td class="p-2 block md:table-cell">Service 2</td>
                  <td class="p-2 block md:table-cell">En attente</td>
                  <td class="p-2 block md:table-cell">01/09/2023</td>
                  <td class="p-2 block md:table-cell">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                      Voir
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
