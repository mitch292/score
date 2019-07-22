<template>
    <div class="mt-4">

        <table class="score-table">

            <tr>
                <th>team</th>
                <th class="text-red">runs</th>
                <th>hits</th>
                <th>errors</th>
                <th>LoB</th>
            </tr>

            <tr>
                <td>{{ awayTeam }}</td>
                <td class="text-red">{{ gameData.linescore.teams.away.runs }}</td>
                <td>{{ gameData.linescore.teams.away.hits }}</td>
                <td>{{ gameData.linescore.teams.away.errors }}</td>
                <td>{{ gameData.linescore.teams.away.leftOnBase }}</td>
            </tr>
            <tr>
                <td>{{ homeTeam }}</td>
                <td class="text-red">{{ gameData.linescore.teams.home.runs }}</td>
                <td>{{ gameData.linescore.teams.home.hits }}</td>
                <td>{{ gameData.linescore.teams.home.errors }}</td>
                <td>{{ gameData.linescore.teams.home.leftOnBase }}</td>
            </tr>

        </table>

    </div>

</template>

<script>

    export default {
        props: {
            gameData: Object,
            homeTeam: String,
            awayTeam: String,
        },
    }
</script>

<style>

</style>
