<style>
    .skills {
        background-color: rgba(255, 255, 255, 0.09);
    }
</style>
<x-app-layout>
    <div class="w-full flex flex-row">
        @include('layouts.aside')
        <div class="w-5/6">
            <div class="flex flex-row items-center py-1 w-full px-2 justify-between">
                <h3 class="text-2xl font-bold text-cyan-800 dark:text-cyan-300">Skills</h3>
                <!-- Success alert -->
                @if (session('success'))
                    <p class="alert text-green-400 text-center">
                        {{ session('success') }}
                    </p>
                @endif
                <form class="m-0" id="createForm" action="{{ route("skills.store") }}" method="POST">
                    @csrf
                    @method("POST")
                    <input type="text" id="name" name="name"
                        class="dark:bg-slate-800 dark:text-gray-300 px-3 py-1.5 -mr-2 border border-slate-400 rounded-md focus:outline-none focus:border-blue-500"
                        required placeholder="Enter skill">
                        <input id="skill_id" type="hidden" name="id">
                    <button id="addSkill"
                        class="cursor-pointer px-3 py-[0.4rem] text-white font-bold bg-blue-600 rounded-e-xl hover:bg-blue-700">
                        + Add Skill
                    </button>
                </form>
            </div>


            <div class="flex flex-col justify-between h-[79dvh] w-full">

                <!-- Skills Table -->
                <table id="skills_table"
                    class="table-auto w-full text-sm whitespace-no-wrap border-spacing-2 px-2 pb-2">
                    <thead class="">
                        <tr class="bg-gray-400">
                            <th class="p-1 border-r border-gray-200">Name</th>
                            <th class="p-1 border-r border-gray-200">Location</th>
                            <th class="p-1 border-r border-gray-200" colspan="2">
                                Manage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($skills as $skill)
                            <tr
                                class="odd:bg-gray-200 even:bg-gray-300 dark:odd:bg-gray-800 dark:even:bg-gray-700 dark:text-gray-300">

                                <td class="w-2/3 p-2 border-r border-white">
                                    <div class="flex flex-row items-center gap-x-2">
                                        <p class="font-semibold">{{ $skill->name }}</p>
                                    </div>
                                </td>

                                <td class="p-2 text-right border-r border-white">
                                    <form class="flex justify-center items-center m-0"
                                        action="{{ route('skills.destroy', $skill->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="hover:bg-red-500 font-semibold hover:text-white text-red-500 border border-red-500 rounded-md p-2"
                                            onclick="return confirmDelete()">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td class="p-2 border-r border-white text-center">
                                    <button data-name="{{ $skill->name }}" data-id="{{ $skill->id }}"
                                        class="editBtn hover:bg-green-500 hover:text-white text-green-500 border border-green-500 rounded-md p-2">Update</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-2">
                    {{ $skills->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        let alert = document.querySelector(".alert");
        if (alert) {
            setTimeout(() => {
                alert.classList.add("hidden");
            }, 3000);
        }

        let form = document.querySelector("#createForm");
        let editBtns = Array.from(document.querySelectorAll(".editBtn"));
        editBtns.forEach(btn => {
            btn.addEventListener("click", () => {
                let name = btn.getAttribute('data-name');
                form.querySelector("#name").setAttribute('value', name);
                form.querySelector("#name").focus();
                form.querySelector("#name").select();
                form.querySelector("button").textContent = "Update";
                form.method = "POST";
                form.querySelector("input[name='_method']").value = "PUT";
                form.querySelector("#skill_id").setAttribute("value", btn.getAttribute('data-id'));
                form.querySelector("button").setAttribute("value", btn.getAttribute("data-name"));
            })
        });
    </script>
</x-app-layout>
