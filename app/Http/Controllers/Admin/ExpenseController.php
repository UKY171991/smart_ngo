<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('project')->latest('expense_date')->paginate(10);
        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $projects = Project::where('status', '!=', 'completed')->get();
        return view('admin.expenses.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'description' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
            'bill_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('bill_image')) {
            $data['bill_image'] = $request->file('bill_image')->store('expenses', 'public');
        }

        $expense = Expense::create($data);

        if ($request->project_id) {
            $project = Project::find($request->project_id);
            $project->spent += $expense->amount;
            $project->save();
        }

        return redirect()->route('admin.expenses.index')->with('success', 'Expense recorded successfully!');
    }

    public function edit(Expense $expense)
    {
        $projects = Project::all();
        return view('admin.expenses.edit', compact('expense', 'projects'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'expense_date' => 'required|date',
            'description' => 'required|string',
            'project_id' => 'nullable|exists:projects,id',
            'bill_image' => 'nullable|image|max:2048',
        ]);

        $oldAmount = $expense->amount;
        $oldProjectId = $expense->project_id;

        $data = $request->all();
        if ($request->hasFile('bill_image')) {
            // Delete old image if exists
            if ($expense->bill_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($expense->bill_image);
            }
            $data['bill_image'] = $request->file('bill_image')->store('expenses', 'public');
        }

        $expense->update($data);

        // Adjust project spending based on changes
        if ($oldProjectId == $request->project_id && $oldProjectId) {
            $project = Project::find($request->project_id);
            $project->spent = $project->spent - $oldAmount + $request->amount;
            $project->save();
        } else {
            if ($oldProjectId) {
                $oldProject = Project::find($oldProjectId);
                if ($oldProject) {
                    $oldProject->spent -= $oldAmount;
                    $oldProject->save();
                }
            }
            if ($request->project_id) {
                $newProject = Project::find($request->project_id);
                if ($newProject) {
                    $newProject->spent += $request->amount;
                    $newProject->save();
                }
            }
        }

        return redirect()->route('admin.expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->project_id) {
            $project = Project::find($expense->project_id);
            if ($project) {
                $project->spent -= $expense->amount;
                $project->save();
            }
        }
        $expense->delete();
        return redirect()->route('admin.expenses.index')->with('success', 'Expense deleted.');
    }
}
